<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class WalletsTable extends AppTable
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

        $validator->notEmpty('user_id', __('Không xác định được người dùng.'));
        $validator->notEmpty('balance', __('Không rõ số dư trong ví.'))
            ->add('balance', [
                'naturalNumber' => [
                    'rule' => ['naturalNumber', true],
                    'message' => __('Số dư trong ví không đủ'),
                ],
            ]);
        return $validator;
    }
}
