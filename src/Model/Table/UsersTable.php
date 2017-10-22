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

        $this->hasMany('UserInfos');
        $this->hasMany('CasterInfos');
    }

    
}
