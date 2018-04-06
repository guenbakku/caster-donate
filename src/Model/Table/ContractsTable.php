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
    }

    public function validationDefault(Validator $validator)
    {
        $Code = new Code(['valueField' => 'id']);

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
            ->notEmpty('birthday', __('Phải nhập ngày sinh.'))
            ->add('birthday', [
                'date' => [
                    'rule' => ['date'],
                    'message' => __('Dữ liệu không hợp lệ.'),
                ]
            ]);

        $validator
            ->notEmpty('address', __('Phải nhập Địa chỉ.'))
            ->add('address', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('address')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('address')),
                ]
            ]);

        return $validator;
    }
}
