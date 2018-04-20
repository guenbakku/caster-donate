<?php
namespace App\Controller\Api\V1;

use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Notification;

class NotificationsController extends ApiController
{
    public function seen()
    {
        $data['result'] = false;

        $user_id = $this->Auth->user('id');
        $Notification = new Notification();
        if ($Notification->seenAll($user_id)) $data['result'] = true;;

        $this->set(compact('data'));
    }
}
