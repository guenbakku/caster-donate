<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use App\Model\Logic\Me;

/**
 * Provide centralized methods to get loged-in user's info in Controller.
 * Use Logic/Me internally.
 */
class MeComponent extends Component
{
    public $components = ['Auth'];

    public function initialize(array $config)
    {
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