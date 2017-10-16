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
        $this->belongsToMany('SocialProviders', [
            'through' => 'UsersSocialProviders',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
            'sort' => ['SocialProviders.order_no'],
        ]);
        $this->belongsToMany('CasterTags',[
            'through' => 'UsersCasterTags',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
            'sort' => ['CasterTags.order_no']
        ]);
        $this->hasMany('UsersCasterTags',[
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('CasterInfos',[
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id'
        ]);

        // Setup upload file
        $this->addBehavior('Upload', [
            'avatar' => [
                'path' => Configure::read('System.Paths.avatar_dir'),
                'keepFileOnEdit' => false,
                'keepFileOnDelete' => false,
                'resizeTo' => Configure::read('vcv.minImageSize'),
            ]
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
            ->allowEmpty('location')
            ->add('location', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('location')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('location')),
                ],
            ]);

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
                    'rule' => ['uploadError', true],
                    'message' => 'Có lỗi xảy ra trong quá trình tải file.',
                ],
                'mimeType' => [
                    'rule' => ['mimeType', Configure::read('vcv.AllowFileTypes.image')],
                    'message' => __('File tải lên có định dạng không hợp lệ.'),
                    'allowEmpty' => true,
                    'last' => true,
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', Configure::read('vcv.uploadFileSize')],
                    'message' => __(
                        'File tải lên phải có dung lượng nhỏ hơn {0}.', 
                        Configure::read('vcv.uploadFileSize')
                    ),
                    'allowEmpty' => true,
                    'last' => true,
                ],
                'minImageSize' => [
                    'rule' => [
                        'imageSize', 
                        [
                            'width' => ['>=', Configure::read('vcv.minImageSize')[0]],
                            'height' => ['>=', Configure::read('vcv.minImageSize')[1]],
                        ],
                    ],
                    'message' => __(
                        'File tải lên phải có chiều rộng lớn hơn {0}px và chiều cao lớn hơn {1}px',
                        Configure::read('vcv.minImageSize')
                    ),
                ]
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
