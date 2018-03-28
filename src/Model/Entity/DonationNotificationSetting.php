<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use App\Utility\Code;

class DonationNotificationSetting extends Entity
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

    public function setDefaultValue()
    {
        $this->_properties['notify_message']    = $this->_properties['notify_message'] ?: '';
        $this->_properties['audio_id']          = $this->_properties['audio_id'] ?: 'resource-0000-000a-udio-public000001';
        $this->_properties['image_id']          = $this->_properties['image_id'] ?: 'resource-0000-0000-0img-public000001';
        $this->_properties['appear_effect']     = $this->_properties['appear_effect'] ?: '#bounce';
        $this->_properties['disappear_effect']  = $this->_properties['disappear_effect'] ?: '#bounceOut';
        $this->_properties['text_color_1']      = $this->_properties['text_color_1'] ?: '#ff7676';
        $this->_properties['text_color_2']      = $this->_properties['text_color_2'] ?: '#ffffff';
        $this->_properties['display_time']      = $this->_properties['display_time'] ?: '6000';
    }
}
