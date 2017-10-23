<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateTransferMethodsTable extends AbstractMigration
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
        $table = $this->table('transfer_methods');
        $table->addColumn('name', 'string', [
            'null' => false,
            'limit' => 255
        ]);
        $table->addColumn('selector', 'string', [
            'null' => false,
            'limit' => 20
        ]);
        $table->addColumn('order_no', 'integer', [
            'null' => true,
            'limit' => 11
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }
}
