<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class DonationNotificationSettingsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);

        $this->belongsTo('Profiles', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id', 
        ]);
        
        $this->belongsTo('AudioResources',[
            'className' =>  'Resources',
            'foreignKey' => 'audio_id',
            'propertyName' => 'audioResources',        
        ]);

        $this->belongsTo('ImageResources',[
            'className' =>  'Resources',
            'foreignKey' => 'image_id',
            'propertyName' => 'imageResources'
            
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id', __('ID không hợp lệ'))
            ->allowEmpty('id', 'create');

        $validator->allowEmpty('notify_message');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
