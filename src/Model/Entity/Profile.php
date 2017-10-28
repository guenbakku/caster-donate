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
}
