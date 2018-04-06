<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class BankAccountsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Contracts', [
            'foreignKey' => 'contract_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->notEmpty('bank', __('Phải nhập Tên ngân hàng.'))
            ->add('bank', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('bank')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('bank')),
                ]
            ]);

        $validator
            ->notEmpty('branch', __('Phải nhập Tên chi nhánh.'))
            ->add('branch', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('branch')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('branch')),
                ]
            ]);

        $validator
            ->notEmpty('holder', __('Phải nhập Tên chủ tài khoản.'))
            ->add('holder', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('holder')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('holder')),
                ]
            ]);

        $validator
            ->notEmpty('number', __('Phải nhập Số tài khoản.'))
            ->add('number', [
                'maxLength' => [
                    'rule' => ['maxLength', $this->columnLength('number')],
                    'message' => __('Không được dài quá {0} ký tự.', $this->columnLength('number')),
                ]
            ]);

        return $validator;
    }
}
