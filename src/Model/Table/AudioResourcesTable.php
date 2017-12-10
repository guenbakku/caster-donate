<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AudioResourcesTable extends AppTable
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsToMany('Profiles', [
            'through' => 'UsersAudioResources',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
        ]);
        $this->hasMany('SettingAlertDonates', [
            'bindingKey' => 'audio_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        /*
        * Tài nguyên mặc định của hệ thống sẽ có user_id là rỗng
        */
        $validator->allowEmpty('user_id');
        $validator->allowEmpty('name');

        $validator
            ->integer('order_no')
            ->allowEmpty('order_no');

        return $validator;
    }
}
