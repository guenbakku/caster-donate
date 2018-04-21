<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Notification;

class NotificationController extends AppController
{
    public $paginate = [
        'limit' => 8,
        'order' => [
            'Notifications.created' => 'desc'
        ],
        'page'=> 1
    ];
    public $helpers = [
        'Paginator' => ['templates' => 'paginator_template']
    ];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thông báo của thành viên'));
        $this->Notification = new Notification();
    }

    public function index()
    {   
        $this->paginate['contain'] = ['NotificationTemplates.NotificationTypes'];
        $this->paginate['conditions'] = ['user_id' => $this->Auth->user('id')];

        $notifications = $this->paginate('Notifications');
        foreach ($notifications as $notification)
        {
            $notification['content'] = $this->Notification->replateVar($notification->notification_template->template, $notification->vars);
        }
        $this->set(compact('notifications'));
    }

    public function showNotification($notif_id)
    {
        $notification = $this->Notification->seen($notif_id);
        if(!empty($notification))
        {
            $this->redirect($notification->notification_template->link);
        }else
        {
            $this->redirect(['action' => 'index']);
        }
    }
}
