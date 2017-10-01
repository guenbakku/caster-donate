<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateCasterInfosCasterTagsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('caster_infos_caster_tags_table', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id','uuid',[
                'null' => false,
            ])
            ->addColumn('caster_info_id','uuid',[
                'null' => false,
            ])
            ->addColumn('created','datetime',[
                'null' => false,
            ])
            ->addColumn('modified','datetime',[
                'null' => false,
            ])
            ->create();
    }
}
