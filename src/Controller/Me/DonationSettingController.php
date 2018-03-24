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
    
    public function notify()
    {
        $user_id = $this->Auth->user('id');

        $DonationNotificationSettingTb = new DonationNotificationSetting();
        $donation_notification_setting = $DonationNotificationSettingTb->get($user_id);
        
        $resourceTb = new Resources();
        $image_resources = $resourceTb->getAllAvailableResources($user_id,'image');

        $this->set(compact('donation_notification_setting','image_resources'));

    }

    
}
