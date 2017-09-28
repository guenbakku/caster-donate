<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateCastersTagsTable extends AbstractMigration
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
        $table = $this->table('casters_tags_table');
        $table
            ->addColumn('id','uuid',[
                'null' => false,
            ])
            ->addColumn('user_id','uuid',[
                'null' => false,
            ])
            ->addColumn('user_id','uuid',[
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
