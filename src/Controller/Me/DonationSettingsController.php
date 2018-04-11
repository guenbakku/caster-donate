<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
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
        if (!$this->Me->get('contract')->is('registered')) {
            return $this->render('/Me/Contract/show_require');
        }
        
        if ($this->Me->get('contract')->is('suspended')) {
            return $this->render('/Me/Contract/show_suspended');
        }

        $user_id = $this->Auth->user('id');
        $DonationNotificationSetting = new DonationNotificationSetting();
        $resourceTb = new Resources();
        $image_resources = $resourceTb->getAllAvailableResources($user_id,'image');
        $audio_resources = $resourceTb->getAllAvailableResources($user_id,'audio');
        
        if ($this->request->is('put')) {
            $new_donation_notification_setting = $this->request->getData();
            $new_donation_notification_setting = $DonationNotificationSetting->edit($user_id, $new_donation_notification_setting);
            if (!$new_donation_notification_setting->errors()) {
                $this->Flash->success(__('Thay đổi thiết lập thông báo donate thành công'));
            } else {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
            }
        }
        $donation_notification_setting = $DonationNotificationSetting->get($user_id);
        

        $this->set(compact('donation_notification_setting','image_resources','audio_resources'));

    }

    
}
