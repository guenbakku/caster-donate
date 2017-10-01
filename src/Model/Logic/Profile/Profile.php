<?php
namespace App\Model\Logic\Profile;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class Profile
{
    public function get($user_id)
    {
        $UserInfos = TableRegistry::get('UserInfos');
        $query = $UserInfos->findByUserId($user_id);
        $query->contain([
            'SocialProviders' => [
                'sort' => ['order_no'],
            ]
        ]);
        
        $userInfo = $query->first();
        
        // $SocialProviders = TableRegistry::get('SocialProviders');
        // debug($SocialProviders->providers());
        // debug($userInfo);
        
        if(!$userInfo)
        {
            return $UserInfos->newEntity();
        }
        return $userInfo;
    }

    public function edit($user_id, array $new_user_info)
    {
        $UserInfos = TableRegistry::get('UserInfos');
        $userInfo = $this->get($user_id);
        $userInfo->user_id = $user_id;

        // Don't update excepted columns, eg: avatar
        $UserInfos->patchEntity($userInfo, $new_user_info, [
            'fieldList' => $UserInfos->columnsExcept(['avatar']),
        ]);

        if(!$userInfo->errors())
        {
            $UserInfos->save($userInfo);

            // Move uploaded file and save filename to database
            $UserInfos->addBehavior('Upload');
            $UserInfos->moveUploadedFileAndSave([
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