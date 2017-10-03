<?php
namespace App\Model\Logic\Profile;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class Profile
{
    public function get($user_id)
    {
        $userInfos = TableRegistry::get('UserInfos');
        $query = $userInfos->findByUserId($user_id);
        $query->contain(['SocialProviders']);

        $userInfo = $query->first();
        if($userInfo)
        {
            $UsersSocialProviders = TableRegistry::get('UsersSocialProviders');
            $userInfo->social_providers = $UsersSocialProviders->repleteEntities($userInfo->social_providers);
        }
        else
        {
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
            'fieldList' => $userInfos->columnsExcept(['avatar']),
            'associated' => ['SocialProviders._joinData'],
        ]);

        if(!$userInfo->errors())
        {
            $userInfos->save($userInfo);

            // Move uploaded file and save filename to database
            $userInfos->addBehavior('Upload');
            $userInfos->moveUploadedFileAndSave([
                'id' => $userInfo->id,
                'uploaded' => $new_user_info['avatar'],
                'to' => Configure::read('System.Paths.avatar'),
                'field' => 'avatar',
            ]);

            // Get new info from database
            $userInfo = $this->get($user_id);
        }

        return $userInfo;
    }
}
?>