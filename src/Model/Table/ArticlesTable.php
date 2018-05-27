<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class ArticlesTable extends AppTable
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

        $validator->notEmpty('title', __('Tiêu đề không được để trống.'));
        $validator->notEmpty('content', __('Nội dung không được để trống.'))
            ->add('content', [
                'maxLength' => [
                    'rule' => ['maxLength', 65000],
                    'message' => __('Không được dài quá 65000ký tự.'),
                ],
            ]);
        return $validator;
    }
}
