<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class UserSocialAccountsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('UserInfos', [
            'foreignKey' => 'user_info_id',
        ]);
        $this->belongsTo('SocialProviders', [
            'foreignKey' => 'social_provider_id',
        ]);
    }
}
