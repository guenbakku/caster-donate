<?php
use Migrations\AbstractMigration;

class CreateWalletsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('wallets', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('balance', 'integer', [
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ])
            ->create();
    }
}
