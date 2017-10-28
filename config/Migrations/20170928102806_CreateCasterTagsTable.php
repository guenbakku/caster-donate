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
        $table = $this->table('caster_tags', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid',[
                'null' => false,
            ])
            ->addColumn('name', 'string',[
                'null' => true,
                'limit' => 256,
            ])
            ->addColumn('image', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('order_no', 'integer',[
                'null' => true,
                'limit' => 11,
            ])
            ->addColumn('created', 'datetime',[
                'null' => false,
            ])
            ->addColumn('modified', 'datetime',[
                'null' => false,
            ])
            ->create();
    }
}
