<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class UsersCasterTagsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users');
        $this->belongsTo('Profiles', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'user_id', // Bind với cột user_id trên bảng Profiles
        ]);
        $this->belongsTo('CasterTags',[
            'foreignKey' => 'caster_tag_id',
        ]);
    }
}
