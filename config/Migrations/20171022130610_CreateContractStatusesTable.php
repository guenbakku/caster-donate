<?php
use Migrations\AbstractMigration;

class CreateContractStatusesTable extends AbstractMigration
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
        $table = $this->table('contract_statuses');
        $table
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
            ])
            ->addColumn('selector', 'string', [
                'null' => false,
                'limit' => 64,
            ])
            ->addColumn('order_no', 'integer', [
                'null' => true,
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
