<?php
namespace App\Model\Logic\Profile;

use Cake\ORM\TableRegistry;

class Profile
{
    public function __construct ()
    {
        $this->UserInfos = TableRegistry::get('UserInfos');
    }

    public function view($user_id)
    {
       
        $userinfo = $this->UserInfos->find()
                            ->where(['user_id' => $user_id])
                            ->first();
        return $userinfo;
    }

    public function add($user_id, array $newuserinfo)
    {
       
        $userinfo = $this->UserInfos->newEntity();
        $this->UserInfos->patchEntity($userinfo, $newuserinfo);
        $userinfo->user_id = $user_id;
        if($this->UserInfos->save($userinfo))
        {
            return true;
        }
        return false;
    }

    public function edit($user_id, array $newuserinfo)
    {
        
        $userinfo = $this->UserInfos->find()
                                    ->where(['user_id' => $user_id])
                                    ->first();
        $this->UserInfos->patchEntity($userinfo, $newuserinfo);
        debug($newuserinfo);
        debug($userinfo);
        if($this->UserInfos->save($userinfo))
        {
            return true;
        }
        return false;
    }
}
?>