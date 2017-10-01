<?php
namespace App\Model\Behavior;

use Cake\ORM\TableRegistry;
use Cake\ORM\Behavior;
use Cake\Utility\Hash;

class RepleteBehavior extends Behavior
{
    protected $_defaultConfig = [
        'belongsTo' => null,
        'sort' => array(),
    ];

    /**
     * Thêm các item còn thiếu vào trong mảng data
     */ 
    public function repleteEntities(array $data) {
        $config = $this->config();

        $Table = TableRegistry::get($config['belongsTo']);
        $standards = $Table->find('all')->order($config['sort'])->toArray();

        $repleted = [];
        foreach ($standards as $si => $standard) {
            foreach ($data as $ji => $item) {
                if ($standard->id == $item->id) {
                    $repleted[$si] = $item;
                    unset($data[$ji]);
                    continue 2;
                }
            }
            $standard->_joinData = $this->_table->newEntity();
            $repleted[$si] = $standard;
        }

        return $repleted;
    }
}