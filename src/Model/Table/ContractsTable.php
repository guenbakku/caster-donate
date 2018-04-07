<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use App\Utility\Code;

class ContractsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('ContractStatuses', [
            'foreignKey' => 'status_id',
        ]);

        $this->belongsTo('Sexes', [
            'foreignKey' => 'sex_id',
        ]);

        $this->hasOne('BankAccounts', [
            'foreignKey' => 'contract_id',
        ]);

        // Setup upload file
        $this->addBehavior('Upload', [
            'identify_card_front' => [
                'path' => Configure::read('System.Paths.identify_card'),
                'keepFilesOnEdit' => false,
                'keepFilesOnDelete' => false,
                'transformer' => null,
            ],
            'identify_card_back' => [
                'path' => Configure::read('System.Paths.identify_card'),
                'keepFilesOnEdit' => false,
                'keepFilesOnDelete' => false,
                'transformer' => null,
            ]
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $Code = new Code(['valueField' => 'id']);

        $validator->provider('Contact', 'App\Model\Validation\ContactValidation');

        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->notEmpty('firstname', __('Phải nhập Họ và tên đệm.'))
            ->add('firstname', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('firstname')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('firstname')),
                ]
            ]);

        $validator
            ->notEmpty('lastname', __('Phải nhập Tên.'))
            ->add('lastname', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('lastname')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('lastname')),
                ]
            ]);

        $validator
            ->notEmpty('sex_id', __('Phải nhập Giới tính.'))
            ->add('sex_id', [
                'inList' => [
                    'rule' => ['inList', $Code->setTable('sexes')->getList()],
                    'message' => __('Dữ liệu không hợp lệ.'),
                ]
            ]);

        $validator
            ->notEmpty('birthday', __('Phải nhập ngày sinh.'));

        $validator
            ->notEmpty('address', __('Phải nhập Địa chỉ.'))
            ->add('address', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('address')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('address')),
                ]
            ]);

        $validator
            ->notEmpty('phone', __('Phải nhập Số điện thoại.'))
            ->add('phone', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('phone')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('phone')),
                ],
                'format' => [
                    'rule' => ['phone'],
                    'provider' => 'Contact',
                    'message' => __('Chỉ được nhập số, khoảng trắng và dấu -'),
                ]
            ]);

        $validator
            ->notEmpty('identify_card_front', __('Phải chọn ảnh tải lên.'))
            ->add('identify_card_front', [
                'uploadError' => [
                    'rule' => ['uploadError', false],
                    'message' => 'Có lỗi xảy ra trong quá trình tải file.',
                    'last' => true,
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
                    'rule' => ['imageWidth', '>=', Configure::read('System.Dimensions.identify_card')[0]],
                    'message' => __(
                        'Chiều rộng ảnh tải lên không được nhỏ hơn {0}.',
                        Configure::read('System.Dimensions.identify_card')[0]
                    ),
                ],
                'minHeight' => [
                    'rule' => ['imageHeight', '>=', Configure::read('System.Dimensions.identify_card')[1]],
                    'message' => __(
                        'Chiều cao ảnh tải lên không được nhỏ hơn {0}.',
                        Configure::read('System.Dimensions.identify_card')[1]
                    ),
                ],
            ]);

        $validator
            ->notEmpty('identify_card_back', __('Phải chọn ảnh tải lên.'))
            ->add('identify_card_back', [
                'uploadError' => [
                    'rule' => ['uploadError', false],
                    'message' => 'Có lỗi xảy ra trong quá trình tải file.',
                    'last' => true,
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
                    'rule' => ['imageWidth', '>=', Configure::read('System.Dimensions.identifyCard')[0]],
                    'message' => __(
                        'Chiều rộng ảnh tải lên không được nhỏ hơn {0}.',
                        Configure::read('System.Dimensions.avatar')[0]
                    ),
                ],
                'minHeight' => [
                    'rule' => ['imageHeight', '>=', Configure::read('System.Dimensions.identifyCard')[1]],
                    'message' => __(
                        'Chiều cao ảnh tải lên không được nhỏ hơn {0}.',
                        Configure::read('System.Dimensions.avatar')[1]
                    ),
                ],
            ]);

        return $validator;
    }
}
