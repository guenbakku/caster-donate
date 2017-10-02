<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CasterTagsTable Model
 *
 * @property \App\Model\Table\CasterInfosTable|\Cake\ORM\Association\BelongsToMany $CasterInfos
 *
 * @method \App\Model\Entity\CasterTagsTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\CasterTagsTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CasterTagsTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CasterTagsTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CasterTagsTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CasterTagsTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CasterTagsTable findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CasterTagsTableTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('caster_tags_table');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('CasterInfos', [
            'foreignKey' => 'caster_tags_table_id',
            'targetForeignKey' => 'caster_info_id',
            'joinTable' => 'caster_infos_caster_tags_table'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('image');

        $validator
            ->integer('order_no')
            ->allowEmpty('order_no');

        return $validator;
    }
}
