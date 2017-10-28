<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Profile
{
    public function __construct()
    {
        $this->profilesTb = TableRegistry::get('Profiles');
    }

    public function get($user_id)
    {
        $profile = $this->profilesTb->findByUserId($user_id)
            ->contain(['SocialProviders', 'CasterTags'])
            ->first();

        if ($profile) {
            $UsersSocialProvidersTb = TableRegistry::get('UsersSocialProviders');
            $profile->social_providers = $UsersSocialProvidersTb->repleteEntities($profile->social_providers);
        }
        else {
            $profile = $this->profilesTb->newEntity();
        }
        return $profile;
    }

    public function edit($user_id, array $new_user_info)
    {
        $profile = $this->get($user_id);
        $profile->user_id = $user_id;

        $this->profilesTb->patchEntity($profile, $new_user_info, [
            'associated' => [
                'SocialProviders._joinData' => ['validate' => 'default'],
            ],
        ]);

        if(!$profile->errors()) {
            $this->profilesTb->save($profile);
        }

        return $profile;
    }

    public function deleteAvatar($user_id)
    {
        $profile = $this->profilesTb->findByUserId($user_id)->first();

        if (!$profile) {
            return false;
        }

        // Call method of UploadBehavior
        return $this->profilesTb->deleteUploadField($profile->id, 'avatar');
    }
}
?>