<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * BaseController for Admin Module.
 * All common settings of Admin module will be set in this controller.
 */
class BaseController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }
}
