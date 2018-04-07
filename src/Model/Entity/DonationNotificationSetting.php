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
        $this->notify_message_array = '{"message1":"___","target1":"\u300cNg\u01b0\u1eddi \u1ee7ng h\u1ed9\u300d","message2":"\u0111\u00e3 \u1ee7ng h\u1ed9","target2":"\u300cS\u1ed1 ti\u1ec1n\u300d","message3":"\u0111\u1ed3ng.","target3":"\u300c___\u300d","message4":"___"}';
        $this->audio_id = 'resource-0000-000a-udio-public000001';
        $this->image_id = 'resource-0000-0000-0img-public000001';
        $this->text_color_1 = '#ff7676';
        $this->text_color_2 = '#ffffff';
        $this->appear_effect = 'bounce';
        $this->disappear_effect = 'bounceOut';
        $this->display_time = '6';
    }
}
