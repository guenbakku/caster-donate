<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateTransferDatasTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('transfer_datas', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ])
        ->addColumn('token', 'string', [
            'limit' => 256,
            'null' => false,
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
