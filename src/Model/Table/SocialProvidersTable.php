<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class SocialProvidersTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsToMany('User', [
            'through' => 'UsersSocialProviders',
        ]);
        $this->belongsToMany('Profiles', [
            'through' => 'UsersSocialProviders',
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id',
        ]);
    }

    /**
     * Return all social providers
     *
     * @param   void
     * @return  array
     */
    public function providers()
    {
        return $this->find('all')->order('order_no')->toArray();
    }
}
