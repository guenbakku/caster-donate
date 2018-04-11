<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class Profile extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getAvatarUrl()
    {
        $filename = $this->_properties['avatar'];
        if (!empty($filename)) {
            return Configure::read('System.Urls.avatar_dir').$filename;
        } else {
            return Configure::read('System.Urls.default_avatar');
        }
    }

    protected function _getFacebook()
    {
        $social_providers = $this->_properties['social_providers'];
        if (!empty($social_providers)) {
            /*
                1) xét công khai hay không
                2) bỏ link https://facebook.com/
                3) 
            */
            return "Chưa xong - src\Model\Entity\Profile.php";
        }else{
            
        }
    }

    protected function _getZalo()
    {

    }
}
