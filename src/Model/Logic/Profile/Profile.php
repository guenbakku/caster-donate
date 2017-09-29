<?php
namespace App\Model\Logic\Profile;

use Cake\ORM\TableRegistry;

class Profile
{
    public function __construct ()
    {
        $this->UserInfos = TableRegistry::get('UserInfos');
    }

    public function get($user_id)
    {
        $user_info = $this->UserInfos->findByUserId($user_id)->first();
        return $user_info;
    }

    public function edit($user_id, array $new_user_info)
    {
        $user_info = $this->UserInfos->findByUserId($user_id)->first();

        if ($user_info === null) 
        {
            $user_info = $this->UserInfos->newEntity();
            $user_info->user_id = $user_id;
        }

        $this->UserInfos->patchEntity($user_info, $new_user_info);

        if(!$user_info->errors())
        {
            $this->UserInfos->save($user_info);
        }

        return $user_info;
    }
}
?>