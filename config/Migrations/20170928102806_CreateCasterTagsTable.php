<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateCasterTagsTable extends AbstractMigration
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
        $table = $this->table('caster_tags_table');
        $table
            ->addColumn('id','uuid',[
                'null' => false,
            ])
            ->addColumn('name','string',[
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('order_no','id',[
                'null' => true,
                'limit' => 11,
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
