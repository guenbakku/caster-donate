<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class UserInfosTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('nickname');

        $validator
            ->allowEmpty('firstname');

        $validator
            ->allowEmpty('lastname');

        $validator
            ->allowEmpty('birthday');

        $validator
            ->allowEmpty('introduction');

        $validator
            ->allowEmpty('avatar')
            ->add('avatar', [
                'uploadError' => [
                    'rule' => 'uploadError',
                    'message' => 'Có lỗi xảy ra trong quá trình tải file.',
                    'allowEmpty' => TRUE,
                ],
                'mimeType' => [
                    'rule' => array('mimeType', Configure::read('vcv.AllowFileTypes.image')),
                    'message' => __('File tải lên có định dạng không hợp lệ.'),
                    'allowEmpty' => TRUE,
                ],
                'fileSize' => [
                    'rule' => array('fileSize', '<=', Configure::read('vcv.uploadFileSize')),
                    'message' => __('File tải lên phải có kích cỡ nhỏ hơn {0}.', Configure::read('vcv.uploadFileSize')),
                    'allowEmpty' => TRUE,
                ],
            ]);

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
