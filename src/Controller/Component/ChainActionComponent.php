<?php

namespace App\Controller\Component;

use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\I18n\Time;
use Cake\Network\Exception\ForbiddenException;

/**
 * Handle multiple steps action.
 */
class ChainActionComponent extends Component
{
    public $components = ['Flash'];

    protected $stepNo;

    public function initialize(array $config)
    {
        $defaultConfig = [
            'key' => 'ChainAction',
            'process' => null,
            'firstStepNo' => 0,
            'timeout' => 3600, // seconds
            'autoDestroy' => true, // auto delete all data of other processes
            'errorMessage' => __('Vui lòng thực hiện lại từ đầu'),
        ];

        $this->setConfig($defaultConfig);
        $this->setConfig($config);
        
        $this->request = $this->getController()->request;
        $this->session = $this->request->session();
    }

    public function shutdown(Event $event)
    {
        if (!$this->getConfig('autoDestroy')) {
            return;
        }

        $key = $this->getConfig('key');
        $data = $this->session->read($key);
        if (empty($data)) {
            return;
        }
        
        foreach ($data as $process => $val) {
            if ($process !== $this->getConfig('process')) {
                $this->session->delete($key.'.'.$process);
            }
        }
    }

    /**
     * Tag step start
     *
     * @param   int: step number
     */
    public function beginStep(int $stepNo, Callable $callable)
    {
        $this->stepNo = $stepNo;

        $previousPath = $this->getSessionPath($this->stepNo - 1);
        $expires = $this->session->read($previousPath.'.expires');
        $isPreviousStepValid = !empty($expires) && $expires > Time::now();
        $isFirstStep = $stepNo === $this->getConfig('firstStepNo');
        
        if (!$isFirstStep && !$isPreviousStepValid) {
            return $this->handleError();
        }

        return \call_user_func($callable);
    }

    /**
     * Tag step completed
     *
     * @param   mixed: data want to pass to next step
     */
    public function complete($results = null)
    {
        $path = $this->getSessionPath($this->stepNo);
        $url = $this->request->here(false);
        $timeout = $this->getConfig('timeout');
        $expires = Time::now();
        $expires->modify("+ {$timeout} seconds");

        $this->session->delete($path);
        $this->session->write($path, [
            'stepNo' => $this->stepNo,
            'url' => $url,
            'results' => $results,
            'expires' => $expires,
        ]);
    }

    public function getStepNo()
    {
        return $this->stepNo;
    }

    /**
     * Return saved data of specific stepNo
     *
     * @param   int: step no
     * @return  mixed
     */
    public function getStepData(int $stepNo = null)
    {   
        $stepNo = $stepNo ?? $this->stepNo;
        $path = $this->getSessionPath($stepNo);
        return $this->session->read($path);
    }

    public function getSessionPath(int $stepNo = null)
    {
        $process = $this->getConfig('process') ?? $this->getController()->name;
        $basePath = $this->getConfig('key').'.'.$process;
        return $stepNo === null? $basePath : $basePath.'.'.$stepNo;
    }

    /**
     * Clear session data of current process
     *
     * @param   int: step no of current process
     *      if null provided, all steps will be cleared.
     * @return  void
     */
    public function clear(int $stepNo = null)
    {
        $path = $this->getSessionPath($stepNo);
        $this->session->delete($path);
    }

    /**
     * Clear session data of all processes.
     *
     * @param   void
     * @param   void
     */
    public function clearAll()
    {
        $path = $this->getConfig('key');
        $this->session->delete($path);
    }

    /**
     * Handle error
     *
     * @param   void
     * @param   void
     */
    protected function handleError()
    {
        $this->Flash->error($this->getConfig('errorMessage'));
        $firstStepNo = $this->getConfig('firstStepNo');
        $firstStepData = $this->getStepData($firstStepNo);
        if (empty($firstStepData)) {
            throw new ForbiddenException("Could not get data of first step `$firstStepNo`");
        }
        return $this->getController()->redirect(Hash::get($firstStepData, 'url'));
    }
}