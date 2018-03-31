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
        $donationNotificationSetting = $this->DonationNotificationSettingTb->findByUserId($user_id)
        ->contain(['AudioResources'])
        ->contain(['ImageResources'])
        ->first();
        
        return $donationNotificationSetting;
    }

    /**
     * Phân loại tag được truyền lên từ form
     * Nếu là tag mới, thêm vào table caster_tags trước rồi 
     * thêm id tag vào danh sách.
     *  [
     *      'new' => ['tag_names'],
     *      'old' => ['tag_ids'],
     *  ]
     */
    public function classify(array $tags)
    {   
        $classified = [
            'new' => [],
            'old' => [],
        ];
        foreach ($tags as $tag) {
            if (Validation::uuid($tag)) {
                $exists = $this->CasterTagsTb->exists(['id' => $tag]);
                if ($exists) {
                    $classified['old'][] = ['caster_tag_id' => $tag];
                }
                continue;
            }

            $exists = $this->CasterTagsTb->findByName($tag)->first();
            if ($exists) {
                $classified['old'][] = ['caster_tag_id' => $exists->id];
                continue;
            }

            $classified['new'][] = ['name' => $tag];
        }
        
        return $classified;
    }
}
?>