<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Hash;

class ContractStatus extends Entity
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

    protected $_extra = [
        'checking' => [
            'class' => 'info',
            'description' => 'Hợp đồng đang được kiểm tra. Bạn sẽ nhận được email thông báo ngay sau khi hợp đồng được kiểm tra xong.',
        ], 
        'valid' => [
            'class' => 'success',
            'description' => 'Hợp đồng đã hoàn tất. Bạn có thể sử dụng tất cả các chức năng của caster.',
        ],
        'inadequacy' => [
            'class' => 'warning',
            'description' => 'Hợp đồng có thiếu sót. Vui lòng cập nhật lại thông tin hợp đồng.',
        ],
        'suspended' => [
            'class' => 'danger',
            'description' => 'Hợp đồng bị tạm ngưng. Vui lòng liên hệ với bộ phận hỗ trợ để biết thêm chi tiết.',
        ],
    ];

    protected function _getBootstrapClass()
    {
        $selector = $this->_properties['selector'];
        return Hash::get($this->_extra, $selector.'.class');
    }

    protected function _getDescription()
    {
        $selector = $this->_properties['selector'];
        return __(Hash::get($this->_extra, $selector.'.description'));
    }
}
