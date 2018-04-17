<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Notification;

class NotificationController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thông báo của thành viên'));
    }

    public function index($notification_id = '')
    {   
       $Notification = new Notification();
       $notifications = $Notification->getNotify($this->Auth->user('id'));

       $this->set(compact('notifications'));
    }
}
