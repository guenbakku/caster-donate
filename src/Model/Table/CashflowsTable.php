<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class CashflowsTable extends AppTable
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

        $validator->notEmpty('wallet_id', __('Không rõ đối tượng của dòng tiền.'));
        $validator->notEmpty('amount', __('Không rõ số tiền của dòng tiền.'))
            ->add('amount', [
                'naturalNumber' => [
                    'rule' => ['naturalNumber'],
                    'message' => __('Số tiền của dòng tiền phải là số tự nhiên lớn hơn 0'),
                ],
            ]);
        $validator->notEmpty('cashflow_type_id', __('Không rõ thể loại dòng tiền.'));
        $validator->notEmpty('transfer_method_id', __('Không rõ phương thức chuyển tiền.'));
        return $validator;
    }
}
