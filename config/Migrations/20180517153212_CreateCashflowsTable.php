<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateCashflowsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('cashflows', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ])
        ->addColumn('wallet_id', 'uuid', [
            'null' => false,
        ])
        ->addColumn('amount', 'integer', [
            'limit' => 11,
            'null' => false,
        ])
        ->addColumn('cashflow_type_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ])
        ->addColumn('transfer_method_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ])
        ->addColumn('result_data', 'string', [
            'limit' => 512,
            'null' => true,
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
