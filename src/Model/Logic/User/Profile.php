<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Profile
{
    public function __construct()
    {
        $this->userInfosTb = TableRegistry::get('UserInfos');
    }

    public function get($user_id)
    {
        $userInfo = $this->userInfosTb->findByUserId($user_id)
            ->contain(['SocialProviders','CasterTags','CasterInfos'])
            ->first();

        if ($userInfo) {
            $UsersSocialProvidersTb = TableRegistry::get('UsersSocialProviders');
            $userInfo->social_providers = $UsersSocialProvidersTb->repleteEntities($userInfo->social_providers);
        }
        else {
            $userInfo = $this->userInfosTb->newEntity();
        }
        return $userInfo;
    }

    public function edit($user_id, array $new_user_info)
    {
        $userInfo = $this->get($user_id);
        $userInfo->user_id = $user_id;

        $this->userInfosTb->patchEntity($userInfo, $new_user_info, [
            'associated' => [
                'SocialProviders._joinData' => ['validate' => 'default'],
            ],
        ]);

        if(!$userInfo->errors()) {
            $this->userInfosTb->save($userInfo);
        }

        return $userInfo;
    }

    public function deleteAvatar($user_id)
    {
        $userInfo = $this->userInfosTb->findByUserId($user_id)->first();

        if (!$userInfo) {
            return false;
        }

        // Call method of UploadBehavior
        return $this->userInfosTb->deleteUploadField($userInfo->id, 'avatar');
    }
}
?>