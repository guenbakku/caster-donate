<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateDonatesTable extends AbstractMigration
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
        $table = $this->table('donates', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('from_id', 'uuid', [
            'null' => true,
        ])
        ->addColumn('to_id', 'uuid', [
            'null' => false,
        ])
        ->addColumn('donater_id', 'uuid', [
            'null' => true,
        ])
        ->addColumn('donater', 'string', [
            'null' => true,
            'limit' => 256,
        ])
        ->addColumn('message', 'string', [
            'null' => true,
            'limit' => 256,
        ])
        ->addColumn('created', 'datetime', [
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }
}
