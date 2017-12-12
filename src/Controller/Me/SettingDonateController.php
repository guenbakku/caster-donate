<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;

class SettingDonateController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thiết lập chức năng Donate'));
    }
    
    public function notifyDonate()
    {
        $user_id = $this->Auth->user('id');
    }

    
}
