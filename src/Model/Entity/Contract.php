<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Utility\Hash;
use App\Utility\Code;

class Contract extends Entity
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

    /**
     * Check status of caster contract
     * Available statuses:
     *      'registered', 'checking', 'valid', 'inadequacy', 'suspended'
     *
     * @param   string: status want to check
     * @param   bool
     */ 
    public function is($status)
    {
        $Code = new Code([
            'keyField' => 'selector',
            'valueField' => 'id',
        ]);
        $statuses = $Code->setTable('contract_statuses')->getList();
        $statusId = Hash::get($this->_properties, 'status_id');
        $status = strtolower($status);
        $availables = array_merge(['registered'], array_keys($statuses)); 

        if (!in_array($status, $availables)) {
            throw new \InvalidArgumentException(
                sprintf('Only accept: %s.', implode(', ', $availables))
            );
        }

        switch ($status) {
            case 'registered': 
                return !empty(Hash::get($this->_properties, 'id'));
            default:
                return $statusId === $statuses[$status];
        }
    }
}
