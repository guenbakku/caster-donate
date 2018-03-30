<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\DonationNotificationSetting;
use App\Model\Logic\User\Resources;

class DonationSettingsController extends AppController

{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thiết lập chức năng Donate'));
    }
    
    public function notify()
    {
        $user_id = $this->Auth->user('id');

        $DonationNotificationSetting = new DonationNotificationSetting();
        $donation_notification_setting = $DonationNotificationSetting->get($user_id);
        
        $resourceTb = new Resources();
        $image_resources = $resourceTb->getAllAvailableResources($user_id,'image');
        $audio_resources = $resourceTb->getAllAvailableResources($user_id,'audio');

        $this->set(compact('donation_notification_setting','image_resources','audio_resources'));

    }

    
}
