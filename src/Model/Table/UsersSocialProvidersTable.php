<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class UsersSocialProvidersTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Replete', [
            'belongsTo' => 'SocialProviders',
            'sort' => ['order_no'],
        ]);

        $this->belongsTo('Users');
        $this->belongsTo('UserInfos', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id' // Bind với cột user_id trên bảng UserInfos
        ]);
        $this->belongsTo('CasterInfos', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id', // Bind với cột user_id trên bảng CasterInfos
        ]);
        $this->belongsTo('SocialProviders');
    }
}
