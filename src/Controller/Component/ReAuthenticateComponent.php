<?php
namespace App\Controller\Component;

use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Hash;

/**
 * Listener for logging input of all controllers
 */
class ReAuthenticateComponent extends Component
{
    protected $_defaultConfig = [
        'bindActions' => [],
        'reAuthenticateRedirect' => [
            'plugin' => false,
            'prefix' => false,
            'controller' => 'ReAuthenticate',
            'action' => 'confirm',
        ],
        'keys' => [
            'session' => 'ReAuthenticate',
            'redirect' => 'redirect',
            'sessionExpires' => 'expires',
        ],
        'timeout' => 900 // seconds
    ];

    public function initialize(array $config)
    {
        $this->setConfig(Configure::read('ReAuthenticate'));
    }

    /**
     * Auto trigger after Controller::beforeFilter()
     *
     * @param   Event: event
     * @return  void
     */
    public function startup(Event $event)
    {
        if (!$this->isBindingAction()) {
            return true;
        }

        if (!$this->isSessionExpired()) {
            return true;
        }
     
        $Controller = $this->getController();
        $here = $Controller->request->here();
        return $Controller->redirect(
            $this->getConfig('reAuthenticateRedirect') + [
                '?' => [
                    $this->getConfig('keys.redirect') => $here,
                ]
            ]
        );
    }

    /**
     * Verify re-authenticate session
     */
    public function isSessionExpired()
    {
        $Controller = $this->getController();
        $expires = $Controller->request->session()->read(
            implode('.', [
                $this->getConfig('keys.session'),
                $this->getConfig('keys.sessionExpires')
            ])
        );

        if (empty($expires)) {
            return true;
        }

        return $expires < Time::now();
    }

    /**
     * Check if current action is a bindingAction or not
     *
     * @param   void
     * @return  bool
     */
    public function isBindingAction()
    {
        $Controller = $this->getController();
        return in_array($Controller->request->action, $this->getConfig('bindActions'));
    }

    /**
     * Set session
     *
     * @param   void
     * @return  void
     */
    public function setSession()
    {
        $sessionKey = $this->getConfig('keys.session');
        $timeout = $this->getConfig('timeout');

        $expires = Time::now();
        $expires->add(new \DateInterval("PT{$timeout}S"));
        $this->getController()->request->session()->write(
            $sessionKey, 
            [$this->getConfig('keys.sessionExpires') => $expires]
        );
    }
}