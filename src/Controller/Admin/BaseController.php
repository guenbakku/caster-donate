<?php
namespace App\Controller\Admin;

use Cake\Event\Event;
use App\Controller\AppController;

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
