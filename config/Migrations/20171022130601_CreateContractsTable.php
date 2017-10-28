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
            ->addColumn('identify_card_front', 'string', [
                'null' => false,
                'limit' => 128,
            ])
            ->addColumn('identify_card_back', 'string', [
                'null' => false,
                'limit' => 128,
            ])
            ->addColumn('filename', 'string', [
                'null' => false,
                'limit' => 128,
            ])
            ->addColumn('phone', 'string', [
                'null' => false,
                'limit' => 64,
            ])
            ->addColumn('firstname', 'string', [
                'null' => false,
                'limit' => 128,
            ])
            ->addColumn('lastname', 'string', [
                'null' => false,
                'limit' => 128,
            ])
            ->addColumn('sex_id', 'integer', [
                'null' => false,
            ])
            ->addColumn('status_id', 'integer', [
                'null' => true,
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
