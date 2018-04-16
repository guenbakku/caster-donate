<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class NotificationTemplatesTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasMany('Notifications', [
            'bindingKey' => 'template_id', 
        ]);
        $this->belongsTo('NotificationTypes', [
            'foreignKey' => 'type_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
       
    }
}