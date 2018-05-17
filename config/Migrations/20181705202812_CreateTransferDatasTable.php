<?php
use Migrations\AbstractMigration;

class CreateTransferDatasTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('transfer_datas', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('token', 'string', [
            'null' => false,
            'limit' => 256,
        ])
        ->create();
    }
}
