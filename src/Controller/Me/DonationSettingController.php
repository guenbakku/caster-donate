<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\DonationNotificationSetting;
use App\Model\Logic\User\Resources;

class DonationSettingController extends AppController

{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thiết lập chức năng Donate'));
    }
    
    public function addNewImage()
    {
        
    }

    public function notify()
    {
        $DonationNotificationSetting = new DonationNotificationSetting();
        $user_id = $this->Auth->user('id');
        $donation_notification_setting = $DonationNotificationSetting->get($user_id);

        $this->set(compact('donation_notification_setting'));

    }

    
}
