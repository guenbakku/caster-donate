<?php
namespace App\Model\Logic\Profile;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class Profile
{
    public function __construct ()
    {
        $this->UserInfos = TableRegistry::get('UserInfos');
    }

    public function get($user_id)
    {
        $userInfo = $this->UserInfos->findByUserId($user_id)->first();
        if(!$userInfo)
        {
            return $this->UserInfos->newEntity();
        }
        return $userInfo;
    }

    public function edit($user_id, array $new_user_info)
    {
        $userInfo = $this->get($user_id);
        $userInfo->user_id = $user_id;

        // Don't update excepted columns, eg: avatar
        $this->UserInfos->patchEntity($userInfo, $new_user_info, [
            'fieldList' => $this->UserInfos->columnsExcept(['avatar']),
        ]);

        if(!$userInfo->errors())
        {
            $this->UserInfos->save($userInfo);

            // Move uploaded file and save filename to database
            $this->UserInfos->addBehavior('Upload');
            $this->UserInfos->moveUploadedFileAndSave([
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