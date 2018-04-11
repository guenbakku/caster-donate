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
        $profiles = $this->profilesTb->find()
            ->where(['Profiles.nickname LIKE' => '%'.$keyword.'%'])
            ->orwhere(['Users.username LIKE' => '%'.$keyword.'%'])
            ->group('Profiles.nickname')
            ->contain(['SocialProviders', 'CasterTags', 'Users'])
            ->all();

        return $profiles;    
    }
}