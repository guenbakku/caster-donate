<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class UsersTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasMany('UserInfos');
        $this->hasMany('CasterInfos');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('token');

        $validator
            ->dateTime('token_expires')
            ->allowEmpty('token_expires');

        $validator
            ->allowEmpty('api_token');

        $validator
            ->dateTime('activation_date')
            ->allowEmpty('activation_date');

        $validator
            ->allowEmpty('secret');

        $validator
            ->boolean('secret_verified')
            ->allowEmpty('secret_verified');

        $validator
            ->dateTime('tos_date')
            ->allowEmpty('tos_date');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('is_superuser')
            ->requirePresence('is_superuser', 'create')
            ->notEmpty('is_superuser');

        $validator
            ->allowEmpty('role');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
