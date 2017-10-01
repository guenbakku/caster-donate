<?php
namespace App\Model\Entity;

use Cake\Core\Configure;

class UserInfo extends AppEntity
{
    protected function _getAvatarUrl()
    {
        $avatar = $this->_properties['avatar'];
        if (!empty($avatar)) {
            return 'avatar/'.$avatar;
        } else {
            return 'default_avatar.jpg';
        }
    }
}
