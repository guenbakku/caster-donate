<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class UsersTable extends \CakeDC\Users\Model\Table\UsersTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasOne('Profiles');
        $this->hasOne('Contracts');
    }

    public function validationDefault(Validator $validator)
    {
        $validator = parent::validationDefault($validator);
        
        $validator->provider('Contact', 'App\Model\Validation\ContactValidation');
        
        $validator
            ->add('username', [
                'format' => [
                    'rule' => ['username'],
                    'provider' => 'Contact',
                    // Message lấy trực tiếp từ giá trị do rule trả về
                ] 
            ]);

        $validator
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', 8],
                    'message' => __('Mật khẩu phải nhiều hơn 8 ký tự'),
                ] 
            ]);

        return $validator;
    }

    public function validationEmail(Validator $validator)
    {
        $validator
            ->add('email', [
                'valid' => [
                    'rule' => 'email'
                ]
            ])
            ->notEmpty('email');

        return $validator;
    }
}
