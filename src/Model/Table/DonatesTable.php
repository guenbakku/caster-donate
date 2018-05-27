<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class DonatesTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator->notEmpty('to_id', __('Không rõ người nhận.'));
        $validator->add('message', [
            'maxLength' => [
                'rule' => ['maxLength', $this->columnLength('message')],
                'message' => __('Lời nhắn không được dài quá {0} ký tự.', $this->columnLength('message')),
            ],
        ]);
        $validator->add('donater', [
            'maxLength' => [
                'rule' => ['maxLength', $this->columnLength('donater')],
                'message' => __('Lời nhắn không được dài quá {0} ký tự.', $this->columnLength('donater')),
            ],
        ]);
        
        return $validator;
    }
}
