<?php
namespace App\Model\Logic\User;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Validation\Validation;

class Notification
{
    public function __construct ()
    {
        $this->NotificationTb = TableRegistry::get('Notifications');
    }

    /**
     * Gửi thông báo đến User
     *
     * @param array $notification
     * @return  Entity|null
     */
    public function notify($new_notification)
    {
        $notification = $this->NotificationTb->newEntity();
        $this->NotificationTb->patchEntity($notification, $new_notification);

        if (!$notification->errors()) {
            $this->NotificationTb->save($notification);
        }

        return $notification;
    }

    public function notifyAll($new_notification)
    {
    }

    public function getNotify($user_id, $limit = '')
    {
        $query = $this->NotificationTb->findByUserId($user_id)    
        ->contain(['NotificationTemplates.NotificationTypes'])
        ->order(['Notifications.created']);
        if(is_numeric($limit)) $query->limit($limit);
        $notifications = $query->all();

        if (empty($notifications)) 
        {
            $notifications = $this->NotificationTb->newEntity();
        }else{
            foreach ($notifications as $notification)
            {
                $notification['notification_template']['content'] = $notification['notification_template']['template'];
            }
        }
        return $notifications;
    }
    
}
?>