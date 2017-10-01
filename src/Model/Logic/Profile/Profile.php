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
        $user_info = $this->UserInfos->findByUserId($user_id)->first();
        if(!$user_info)
        {
            return $this->UserInfos->newEntity();
        }
        return $user_info;
    }

    public function edit($user_id, array $new_user_info)
    {
        $user_info = $this->get($user_id);
        $user_info->user_id = $user_id;

        // Don't update excepted columns, eg: avatar
        $this->UserInfos->patchEntity($user_info, $new_user_info, [
            'fieldList' => $this->UserInfos->columnsExcept(['avatar']),
        ]);

        if(!$user_info->errors())
        {
            $this->UserInfos->save($user_info);

            // Move uploaded file and save filename to database
            $this->UserInfos->addBehavior('Upload');
            $this->UserInfos->moveUploadedFileAndSave([
                'id' => $user_info->id,
                'uploaded' => $new_user_info['avatar'],
                'to' => Configure::read('System.Paths.avatar'),
                'field' => 'avatar',
            ]);

            // Get new info from database
            $user_info = $this->get($user_id);
        }

        return $user_info;
    }
}
?>