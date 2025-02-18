<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class ProfilesTable extends AppTable
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

        //Tag
        $this->belongsToMany('CasterTags',[
            'through' => 'UsersCasterTags',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
            'sort' => ['CasterTags.order_no']
        ]);
        $this->hasMany('UsersCasterTags',[
            'foreignKey' => 'user_id'
        ]);

        //
        $this->hasOne('DonationNotificationSettings',[
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id'
        ]);

        //Resource
        $this->hasMany('Resources',[
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
        ]);

        //Schedules
        $this->hasMany('Schedules',[
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id'
        ]);
        $this->hasMany('ScheduleEventLabels',[
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id'
        ]);

        // Setup upload file
        $this->addBehavior('Upload', [
            'avatar' => [
                'path' => Configure::read('System.Paths.avatar_dir'),
                'keepFilesOnEdit' => false,
                'keepFilesOnDelete' => false,
                'resizeTo' => Configure::read('System.Dimensions.avatar'),
            ]
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
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
            ->allowEmpty('introduction')
            ->add('introduction', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('introduction')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('introduction')),
                ],
            ]);

        $validator
            ->notEmpty('avatar', __('Phải chọn ảnh tải lên.'))
            ->add('avatar', [
                'uploadError' => [
                    'rule' => ['uploadError', true],
                    'message' => 'Có lỗi xảy ra trong quá trình tải file.',
                ],
                'mimeType' => [
                    'rule' => ['mimeType', Configure::read('vcv.AllowFileTypes.image')],
                    'message' => __('File tải lên có định dạng không hợp lệ.'),
                    'last' => true,
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', Configure::read('vcv.uploadFileSize')],
                    'message' => __(
                        'File tải lên phải có dung lượng nhỏ hơn {0}.', 
                        Configure::read('vcv.uploadFileSize')
                    ),
                    'last' => true,
                ],
                'minWidth' => [
                    'rule' => ['imageWidth', '>=', Configure::read('System.Dimensions.avatar')[0]],
                    'message' => __(
                        'Chiều rộng ảnh tải lên không được nhỏ hơn {0}.',
                        Configure::read('System.Dimensions.avatar')[0]
                    ),
                ],
                'minHeight' => [
                    'rule' => ['imageHeight', '>=', Configure::read('System.Dimensions.avatar')[1]],
                    'message' => __(
                        'Chiều cao ảnh tải lên không được nhỏ hơn {0}.',
                        Configure::read('System.Dimensions.avatar')[1]
                    ),
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
