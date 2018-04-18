<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;
use App\Model\Logic\User\Notification;

class NotificationsMenuCell extends Cell
{
    public function display($user_id)
    {
        $Notification = new Notification();
        $notifications = $Notification->getNotify($user_id,10);

        $this->set(compact('notifications'));
    }
}