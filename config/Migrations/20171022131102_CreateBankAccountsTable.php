<?php
use Migrations\AbstractMigration;

class CreateBankAccountsTable extends AbstractMigration
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
        $table = $this->table('bank_accounts', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 256,
            ])
            ->addColumn('branch', 'string', [
                'null' => true,
                'limit' => 256,
                'default' => null
            ])
            ->addColumn('holder', 'string', [
                'null' => false,
                'limit' => 256,
            ])
            ->addColumn('number', 'string', [
                'null' => false,
                'limit' => 256,
            ])
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ])
            ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'))
            ->create();
    }
}
