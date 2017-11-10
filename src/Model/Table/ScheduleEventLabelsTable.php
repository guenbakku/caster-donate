<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ScheduleEventLabelsTable extends AppTable
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Profiles', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('className');

        return $validator;
    }
}