<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use App\Utility\Code;

class Resource extends Entity
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
     * Return full url of resource
     *
     * @param   void
     * @return  string
     */
    protected function _getUrl()
    {
        $Code = new Code(['valueField' => 'selector']);
        $resource_type_id =& $this->_properties['resource_type_id'];
        $resource_types = $Code->setTable('resource_types')->getList();
        $resource_type = $resource_types[$resource_type_id];

        $path = Configure::read('System.Urls.resource_dir.'.$resource_type);
        $filename =& $this->_properties['filename'];

        return $path.$filename;
    }
}
