<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;
use App\Model\Logic\User\Notification;

class NotificationsMenuCell extends Cell
{
    public function display($user_id)
    {
        $NotificationLg = new Notification();
        $notifications = $NotificationLg->getNewNotify($user_id);

        $this->set(compact('notifications'));
    }
}