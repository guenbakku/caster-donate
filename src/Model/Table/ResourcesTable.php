<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Core\Configure;
use Cake\Validation\Validator;

class ResourcesTable extends AppTable
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
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
        ]);

        $this->belongsTo('ResourceTypes',[
            'foreignKey' => 'resource_type_id',
        ]);

        // Setup upload file
        $this->addBehavior('Upload', [
            // Setting default. Các setting khác sẽ được set ở Logic
            'filename' => [
                'keepFilesOnEdit' => false,
                'keepFilesOnDelete' => false,
            ]
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
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'name','user_id');

        $validator
            ->notEmpty('filename', __('Phải chọn ảnh tải lên'))
            ->add('filename', [
                'uploadError' => [
                    'rule' => ['uploadError', true],
                    'message' => __('Có lỗi xảy ra trong quá trình tải file.'),
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', Configure::read('vcv.uploadFileSize')],
                    'message' => __(
                        'File tải lên phải có dung lượng nhỏ hơn {0}.', 
                        Configure::read('vcv.uploadFileSize')
                    ),
                    'last' => true,
                ],
            ]);
        
        return $validator;
    }

    public function validationImage(Validator $validator){
        $validator = $this->validationDefault($validator);
        $validator
            ->notEmpty('filename', __('Phải chọn ảnh tải lên'))
            ->add('filename', [
                'mimeType' => [
                    'rule' => ['mimeType', Configure::read('vcv.AllowFileTypes.image')],
                    'message' => __('File ảnh tải lên có định dạng không hợp lệ.'),
                    'last' => true,
                ],
            ]);
        return $validator;
    }

    public function validationAudio(Validator $validator){
        $validator = $this->validationDefault($validator);
        $validator
            ->notEmpty('filename', __('Phải chọn ảnh tải lên'))
            ->add('filename', [
                'mimeType' => [
                    'rule' => ['mimeType', Configure::read('vcv.AllowFileTypes.audio')],
                    'message' => __('File âm thanh tải lên có định dạng không hợp lệ.'),
                    'last' => true,
                ],
            ]);
        return $validator;
    }
}
