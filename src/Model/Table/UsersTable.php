<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class UsersTable extends Table
{

   
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->hasMany('UserInfos', [
            'foreignKey' => 'user_id'
        ]);
    }

}
