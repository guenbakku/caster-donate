<?php

namespace App\Model\Logic;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use App\Utility\CentralCacheTrait;

/**
 * Provide centralized methods to get loged-in user's info.
 */
class Me
{
    use CentralCacheTrait;

    protected static $instance = null;
    protected $Auth = null;

    protected function __construct($Auth) {
        $this->Auth = $Auth;
    }

    public static function getInstance($Auth)
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($Auth);
        }
        return static::$instance;
    }

    /**
     * Accessor to all accessable items
     *
     * @param   string
     * @return  mixed
     */
    public function get(string $path)
    {
        if (method_exists($this, $path)) {
            return $this->$path();
        } else {
            return $this->Auth->user($path);
        }
    }

    protected function isAuthenticated()
    {
        return !empty($this->Auth->user());
    }

    /**
     * Check if a user is a caster
     *
     * @param   void
     * @return  bool
     */
    protected function isCaster()
    {
        $isCaster = $this->rememberCache('isCaster', function () {
            $userId = $this->Auth->user('id');
            $contractsTb = TableRegistry::get('Contracts');
            $query = $contractsTb->find()
                ->where(['Contracts.user_id' => $userId])
                ->where(['ContractStatuses.selector' => 'valid'])
                ->contain(['ContractStatuses']);
            return !$query->isEmpty();
        });

        return $isCaster;
    }
}