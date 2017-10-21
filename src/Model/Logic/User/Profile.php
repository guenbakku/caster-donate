<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Profile
{
    public function get($user_id)
    {
        $userInfos = TableRegistry::get('UserInfos');
        $query = $userInfos->findByUserId($user_id);
        $query->contain(['SocialProviders','CasterTags','CasterInfos']);
        $userInfo = $query->first();
        if ($userInfo) {
            $UsersSocialProviders = TableRegistry::get('UsersSocialProviders');
            $userInfo->social_providers = $UsersSocialProviders->repleteEntities($userInfo->social_providers);
        }
        else {
            return $userInfos->newEntity();
        }
        return $userInfo;
    }

    public function edit($user_id, array $new_user_info)
    {
        $userInfos = TableRegistry::get('UserInfos');
        $userInfo = $this->get($user_id);
        $userInfo->user_id = $user_id;

        // Don't update excepted columns, eg: avatar
        $userInfos->patchEntity($userInfo, $new_user_info, [
            'associated' => [
                'SocialProviders._joinData' => ['validate' => 'default'],
            ],
        ]);

        if(!$userInfo->errors()) {
            $userInfos->save($userInfo);
            $userInfo = $this->get($user_id);
        }

        return $userInfo;
    }

    public function deleteAvatar($user_id)
    {
        $userInfos = TableRegistry::get('UserInfos');
        $userInfo = $userInfos->findByUserId($user_id)->first();

        if (!$userInfo) {
            return false;
        }

        $dir = Configure::read('System.Paths.avatar');
        $path = $dir.$userInfo->avatar;
        
        if (!empty($userInfo->avatar) && Flysystem::getFilesystem()->has($path)) {
            Flysystem::getFilesystem()->delete($path);
        }

        if ($userInfos->behaviors()->loaded('Upload')) {
            $userInfos->removeBehavior('Upload');
        }

        $userInfo->avatar = null;
        return $userInfos->save($userInfo);
    }
}
?>