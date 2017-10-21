<?php
namespace App\Controller\Component;

use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Utility\Hash;

/**
 * Listener for logging input of all controllers
 */
class AutoLogComponent extends Component
{
    protected const LOG_KEYS = [
        'client_ip', 'server_ip', 'user_id', 'request_uri', 'request_method',
        'referer', 'prefix', 'plugin', 'controller', 'action', 'matched_route',
        'is_ajax', 'pass', 'data', 'query', 'session_cookie', 'user_agent',
    ];

    protected $_defaultConfig = [
        'log_scope' => 'access',

        'log_keys' => [],

        /**
         * Define list of sensitive keys which need to be masked before write to log.
         * If following keys exist in input data, their value will be masked by '***'.
         * Structure of mask is like following (data_key must be Regex format):
         *  [
         *      [
         *          'plugin' => [],
         *          'prefix' => [],
         *          'controller' => [],
         *          'action' => [],
         *          'log_keys' => [],
         *          'mask_keys' => ['/password/', '/credit.+/'],
         *      ]
         *  ]
         */
        'mask_rules' => [],

        'masker' => '***',
    ];

    public function initialize(array $config)
    {
        if (empty($this->getConfig('log_keys'))) {
            $this->setConfig('log_keys', static::LOG_KEYS);
        }
    }

    public function startup(Event $event)
    {
        $data = $this->collectInput();
        $data_masked = $this->mask($data);
        $this->writeLog($data_masked);
    }

    /**
     * Log all input all controllers
     *
     * @param   object: event
     * @return  void
     */
    public function collectInput()
    {
        $Controller = $this->getController();

        // Trust HTTP_X headers set by most load balancers.
        // This must be enabled to get true ip of client.
        $Controller->request->trustProxy = true;

        // Collect logging info
        $request_uri = env('REQUEST_URI');
        $request_method = env('REQUEST_METHOD');
        $user_agent = env('HTTP_USER_AGENT');
        $server_ip = env('SERVER_ADDR'); // <- This will be internal ip if server is behind load balancer
        $referer = env('HTTP_REFERER');
        
        $client_ip = $Controller->request->clientIp();
        $prefix = $Controller->request->getParam('prefix');
        $plugin = $Controller->request->getParam('plugin');
        $controller = $Controller->request->getParam('controller');
        $action = $Controller->request->getParam('action');
        $matched_route = $Controller->request->getParam('_matchedRoute');
        $is_ajax = $Controller->request->getParam('isAjax');
        $pass = $Controller->request->getParam('pass');
        $data = $Controller->request->getData();
        $query = $Controller->request->getQuery();
        
        $session_cookie_name = Configure::read('Session.cookie');
        $session_cookie = $Controller->request->cookie($session_cookie_name);
        $user_id = $Controller->request->session()->read('Auth.User.id');

        // Define output order
        $log = compact(...$this->getConfig('log_keys'));

        return $log;
    }

    /**
     * Write log
     *
     * @param   array|string: data
     * @return  void
     */
    public function writeLog($data)
    {
        if (!is_scalar($data)) {
            $data = $this->toString($data);
        }
        Log::info($data, ['scope' => $this->getConfig('log_scope')]);   
    }

    /**
     * Create log message from array
     *
     * @param   array
     * @return  string
     */
    public function toString(array $data)
    {
        return json_encode($data);
    }

    /**
     * Mask value of sensitive keys
     *
     * @param   array: log data
     * @return  array: masked log data
     */
    public function mask(array $data)
    {
        $Controller = $this->getController();

        $params = $Controller->request->getAttribute('params');
        $reserved = [
            'prefix' => Hash::get($params, 'prefix'),
            'plugin' => Hash::get($params, 'plugin'),
            'controller' => Hash::get($params, 'controller'),
            'action' => Hash::get($params, 'action'),
            'log_keys' => $this->getConfig('log_keys'),
            'mask_keys' => [],
        ];

        $parseRule = function (array $rule) use ($reserved) {
            $parsed = [];
            foreach ($reserved as $key => $val) {
                $parsed[$key] = Hash::get($rule, $key);
                if (empty($parsed[$key])) {
                    $parsed[$key] = is_array($val)? $val : [$val];
                }
            }

            return $parsed;
        };

        $isRuleMatched  = function (array $parsed_rule) use ($reserved) {
            return in_array($reserved['prefix'], $parsed_rule['prefix'])
                   && in_array($reserved['plugin'], $parsed_rule['plugin'])
                   && in_array($reserved['controller'], $parsed_rule['controller'])
                   && in_array($reserved['action'], $parsed_rule['action']);
        };

        $mask = function (array $data, array $log_keys, array $mask_keys) {
            foreach ($log_keys as $log_key) {
                if (!isset($data[$log_key])) {
                    continue;
                }
                
                $log_data =& $data[$log_key];
                if (is_scalar($log_data)) {
                    $log_data = $this->getConfig('masker');
                    continue;
                }

                // Flatten data to 1 dimension array
                // to make it easier for matching pattern to key
                $log_data = (array) $log_data;
                $log_data = Hash::flatten($log_data);
                foreach ($log_data as $path => $val) {
                    foreach ($mask_keys as $mask_key) {
                        if (preg_match($mask_key, $path)) {
                            $log_data[$path] = $this->getConfig('masker');
                        }
                    }
                }

                // Rebuild data
                $log_data = Hash::expand($log_data);
            }

            return $data;
        };

        foreach ($this->getConfig('mask_rules') as $rule) {
            $parsed_rule = $parseRule($rule);
            if ($isRuleMatched($parsed_rule)) {
                $data = $mask($data, $parsed_rule['log_keys'], $parsed_rule['mask_keys']);
            }
        }

        return $data;
    }
}