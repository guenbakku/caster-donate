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
     * @param string $user_id 
     *    user_id có thể là null => gửi thông báo đến toàn bộ user
     *    (cố ý tách riêng user_id ra khỏi array để lúc gọi hàm tránh trường hợp quên set dẫn đến thông báo toàn bộ)
     * @param array $notification ['title','content'] 
     * @return  Entity|null
     */
    public function notify($user_id, array $new_notification)
    {
        $new_notification   =   array_merge($new_notification, [
            'user_id' => $user_id,
            'seen' => false
        ]);

        $notification = $this->NotificationTb->newEntity();
        $this->NotificationTb->patchEntity($notification, $new_notification);

        if (!$notification->errors()) {
            $this->NotificationTb->save($notification);
        }

        return $notification;
    }

    public function getNotify($user_id, $limit = '')
    {
        $query = $this->NotificationTb->find()
        ->where([
            "OR" => [
                "user_id is" => null,
                "user_id" => $user_id
            ]
        ])
        ->order(['created']);
        if(is_numeric($limit)) $query->limit($limit);
        $notifications = $query->all();

        if (empty($notifications)) {
            $notifications = $this->NotificationTb->newEntity();
        }

        return $notifications;
    }
    
}
?>