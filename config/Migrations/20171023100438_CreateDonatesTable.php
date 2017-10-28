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
        $table->addColumn('sender_id', 'uuid', [
            'null' => true,
        ]);
        $table->addColumn('sender_name', 'string', [
            'limit' => 256,
            'null' => true,
        ]);
        $table->addColumn('receiver_id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('amount', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('donate_method_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('message', 'string', [
            'limit' => 512,
            'null' => true,
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
