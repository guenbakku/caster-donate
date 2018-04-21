<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class NotificationTypesTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasMany('NotificationTemplates', [
            'foreignKey' => 'type_id',
        ]);

    }

    public function validationDefault(Validator $validator)
    {
       
    }
}
