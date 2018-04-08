<?php

namespace App\Controller\Component;

use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Network\Exception\ForbiddenException;

/**
 * Handle multiple steps action.
 */
class ChainActionComponent extends Component
{
    public $components = ['Flash'];

    protected $step;
    protected $stepNo;

    public function initialize(array $config)
    {
        $defaultConfig = [
            'key' => 'ChainAction',
            'process' => null,
            'steps' => [],
            'timeout' => 1800, // seconds
            'autoDestroy' => false, // auto delete all data of other processes
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
    public function beginStep(Callable $callable)
    {
        if ($this->step === null) {
            $action = $this->getController()->request->action;
            $this->setStep($action);
        }

        $previousPath = $this->getSessionPath($this->stepNo - 1);
        $expires = $this->session->read($previousPath.'.expires');
        $isPreviousStepValid = !empty($expires) && $expires > Time::now();
        $isFirstStep = $this->stepNo === 0;
        
        if (!$isFirstStep && !$isPreviousStepValid) {
            return $this->handleError();
        }

        return call_user_func($callable);
    }

    /**
     * Tag step completed
     *
     * @param   mixed: data want to pass to next step
     */
    public function completeStep($results = null)
    {
        $path = $this->getSessionPath($this->stepNo);
        $url = $this->request->here(false);
        $timeout = $this->getConfig('timeout');
        $expires = Time::now();
        $expires->modify("+ {$timeout} seconds");

        $this->session->delete($path);
        $this->session->write($path, [
            'step' => $this->step,
            'stepNo' => $this->stepNo,
            'url' => $url,
            'results' => $results,
            'expires' => $expires,
        ]);
    }

    /**
     * Set step name
     *
     * @param   string
     * @return  void
     */
    public function setStep(string $step)
    {
        $this->step = $step;
        $this->stepNo = $this->determineStepNo($this->step);
    }

    public function getStep()
    {
        return $this->step;
    }

    public function getStepNo()
    {
        return $this->stepNo;
    }

    /**
     * Return saved data of specific stepNo
     *
     * @param   int|string: step no or step name
     * @return  mixed
     */
    public function getStepData($step = null)
    {   
        if ($step === null) {
            $stepNo = $this->stepNo;
        } elseif (is_string($step)) {
            $stepNo = $this->determineStepNo($step);
        } elseif (is_int($step)) {
            $stepNo = $step;
        } else {
            throw new \InvalidArgumentException('step is invalid.');
        }

        $path = $this->getSessionPath($stepNo);
        $data = $this->session->read($path);
        if ($data === null) {
            return null;
        }
        if (Hash::get($data, 'expires') < Time::now()) {
            return null;
        }
        return Hash::get($data, 'results');
    }

    /**
     * Return path to the data of provided step no in session storage
     * 
     * @param   int: step no
     *      if null provided, the path to current process will be returned.
     * @return  string
     */
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
     *      if null provided, all steps of process will be cleared.
     * @return  void
     */
    public function clear(int $stepNo = null)
    {
        $path = $this->getSessionPath($stepNo);
        $this->session->delete($path);
    }

    /**
     * Return list of steps of specific process
     *
     * @param   string|null
     * @return  array
     */
    protected function getProcessSteps(?string $process = null)
    {
        $steps = $this->getConfig('steps');
        if ($process !== null) {
            $steps = Hash::get($steps, $process);
        }
        if (empty($steps)) {
            throw new \RuntimeException('Please specify list of steps.');
        }
        return $steps;
    }

    /**
     * Determine step no from step name
     *
     * @param   string
     * @param   int
     */
    protected function determineStepNo(string $step)
    {
        $process = $this->getConfig('process');
        $steps = $this->getProcessSteps($process);
        $stepNo = array_search($step, $steps);
        if ($stepNo === false) {
            throw new \RuntimeException(
                sprintf('Could not find step name `%s` in step list.', $this->step)
            );
        }

        return $stepNo;
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
        $process = $this->getConfig('process');
        $steps = $this->getProcessSteps($process);
        $firstStepUrl = Router::parseRequest($this->request);
        $firstStepUrl['action'] = $steps[0];
        $firstStepUrl = Router::reverse($firstStepUrl);
        return $this->getController()->redirect($firstStepUrl);
    }
}