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
        $this->UserNotificationTb = TableRegistry::get('UserNotifications');
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

        $userNotification = $this->UserNotificationTb->newEntity();
        $this->UserNotificationTb->patchEntity($userNotification, $new_notification);

        if (!$userNotification->errors()) {
            $this->UserNotificationTb->save($userNotification);
        }

        return $userNotification;
    }

    public function getNotify($user_id)
    {
        $notifications = $this->UserNotificationTb->find()
        ->where([
            "OR" => [
                "user_id is" => null,
                "user_id" => $user_id
            ]
        ])
        ->order(['created'])
        ->limit(10)
        ->all();

        if (empty($notifications)) {
            $notifications = $this->UserNotificationTb->newEntity();
        }

        return $notifications;
    }
    
}
?>