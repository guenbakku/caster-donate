<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Search
{
    public function __construct()
    {
        $this->profilesTb = TableRegistry::get('Profiles');
    }

    public function searchAll(string $keyword)
    {
        $users = $this->profilesTb->find()
            ->where(['Profiles.nickname LIKE' => '%'.$keyword.'%'])
            ->orwhere(['Profiles.firstname LIKE' => '%'.$keyword.'%'])
            ->orwhere(['Profiles.lastname LIKE' => '%'.$keyword.'%'])
            ->group('Profiles.nickname')
            ->contain(['SocialProviders', 'CasterTags'])
            ->all();

        foreach($users as $user){
            $user['avatar'] = $user->get('avatar_url');
            $user['facebook'] = $user->get('facebook');
            $user['fullname'] = $user->get('fullname');
        }

        return $users;    
    }
}