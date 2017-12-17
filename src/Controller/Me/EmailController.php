<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Tag;

class EmailController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('ReAuthenticate', [
            'bindActions' => ['edit'],
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Địa chỉ email'));
    }

    public function edit()
    {   
        
    }
}
