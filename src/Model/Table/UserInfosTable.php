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
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id', __('ID không hợp lệ'))
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('nickname')
            ->add('nickname', [
                'minLength' => [
                    'rule' => ['minLength', 3],
                    'message' => __('Không được ngắn hơn {0} ký tự.', 3),
                ],
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('nickname')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('nickname')),
                ],
            ]);

        $validator
            ->allowEmpty('firstname')
            ->add('firstname', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('firstname')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('firstname')),
                ],
            ]);

        $validator
            ->allowEmpty('lastname')
            ->add('lastname', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('lastname')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('lastname')),
                ],
            ]);

        $validator
            ->allowEmpty('birthday');

        $validator
            ->allowEmpty('introduction')
            ->add('introduction', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('introduction')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('introduction')),
                ],
            ]);

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
