<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class UsersSocialProvidersTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Replete', [
            'belongsTo' => 'SocialProviders',
            'sort' => ['order_no'],
        ]);

        $this->belongsTo('Users');
        $this->belongsTo('UserInfos', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id' // Bind với cột user_id trên bảng UserInfos
        ]);
        $this->belongsTo('CasterInfos', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id', // Bind với cột user_id trên bảng CasterInfos
        ]);
        $this->belongsTo('SocialProviders');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('reference')
            ->add('reference', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('reference')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('reference')),
                ],
            ]);

        return $validator;
    }
}
