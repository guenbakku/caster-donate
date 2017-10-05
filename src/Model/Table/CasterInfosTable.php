<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class CasterInfosTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsToMany('SocialProviders', [
            'through' => 'UsersSocialProviders',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
            'sort' => ['SocialProviders.order_no'],
        ]);
        $this->belongsToMany('CasterTags',[
            'through' => 'UsersCasterTags',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
            'sort' => ['CasterTags.order_no']
        ]);
        $this->belongsTo('UserInfos',[
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
        ]);
    }
}
