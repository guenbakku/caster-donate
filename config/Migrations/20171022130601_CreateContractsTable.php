<?php
use Migrations\AbstractMigration;

class CreateContractsTable extends AbstractMigration
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
        $table = $this->table('contracts', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('bank_card', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('identify_no', 'string', [
                'null' => true,
                'limit' => 32,
            ])
            ->addColumn('identify_card_front', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('identify_card_back', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('filename', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('phone', 'string', [
                'null' => true,
                'limit' => 64,
            ])
            ->addColumn('firstname', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('lastname', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('birthday', 'date', [
                'null' => true,
            ])
            ->addColumn('sex_id', 'integer', [
                'null' => true,
            ])
            ->addColumn('address', 'string', [
                'null' => true,
                'limit' => 512,
            ])
            ->addColumn('status_id', 'integer', [
                'null' => false,
                'default' => 1,
            ])
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ])
            ->addIndex(['user_id'], ['unique' => true])
            ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'))
            ->create();
    }
}
