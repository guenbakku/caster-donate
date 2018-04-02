<?php
namespace App\Model\Logic\User;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Validation\Validation;
use Cake\Utility\Hash;

class DonationNotificationSetting
{
    public function __construct ()
    {
        $this->DonationNotificationSettingTb = TableRegistry::get('DonationNotificationSettings');
    }

    public function get($user_id)
    {
        /*  1 record của DonateNotificationSetting với giá trị mặc định đã được tạo khi user đăng ký
        *       ,nên không xét trường hợp để trả về newEntỉty() ở đây
        */
        $donationNotificationSetting = $this->DonationNotificationSettingTb->findByUserId($user_id)
        ->contain(['AudioResources'])
        ->contain(['ImageResources'])
        ->first();
        
        return $donationNotificationSetting;
    }

    public function edit($user_id, array $new_donate_setting)
    {
        $donate_setting = $this->get($user_id);

        $this->DonationNotificationSettingTb->patchEntity($donate_setting, $new_donate_setting);

        if(!$donate_setting->errors()) {
            $this->DonationNotificationSettingTb->save($donate_setting);
        }

        return $donate_setting;
    }
}
?>