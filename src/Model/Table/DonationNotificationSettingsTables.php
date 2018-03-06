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
            'bindingKey' => 'user_id', // Bind với cột user_id trên bảng Profiles
        ]);
        $this->belongsTo('AudioResources',[
            'foreignKey' => 'audio_id',
        ]);
        $this->belongsTo('ImageResources',[
            'foreignKey' => 'image_id',
        ]);
        $this->hasOne('TextEffects',[
            'foreignKey' => 'text_effect_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id', __('ID không hợp lệ'))
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('message1')
            ->add('message1', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('message1')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('message1')),
                ],
            ]
        );
        $validator
            ->allowEmpty('message2')
            ->add('messagemessage21', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('message2')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('message2')),
                ],
            ]
        );
        $validator
            ->allowEmpty('message3')
            ->add('message3', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('message3')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('message3')),
                ],
            ]
        );
        $validator->allowEmpty('target1');
        $validator->allowEmpty('target2');

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
