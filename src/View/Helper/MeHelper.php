<?php

namespace App\View\Helper;

use Cake\View\Helper;
use App\Model\Logic\Me;

/**
 * Provide centralized methods to get loged-in user's info in Template.
 * Use Logic/Me internally.
 */
class MeHelper extends Helper
{
    public $helpers = ['Auth'];

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->Me = Me::getInstance($this->Auth);
    }

    /**
     * Proxy for accessing to methods of Logic/Me.
     * 
     * @param   string: method (must in camelCase)
     * @param   array: first item contain path to value in session
     */
    public function __call($name, $args)
    {
        return $this->Me->$name(...$args);
    }
}
