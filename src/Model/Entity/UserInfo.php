<?php
namespace App\Model\Entity;

use Cake\Core\Configure;

class UserInfo extends AppEntity
{
    protected function _getAvatarUrl()
    {
        $filename = $this->_properties['avatar'];
        if (!empty($filename)) {
            return Configure::read('System.Urls.avatar_dir').$filename;
        } else {
            return Configure::read('System.Urls.default_avatar');
        }
    }
}
