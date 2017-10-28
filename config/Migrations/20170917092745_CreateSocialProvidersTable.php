<?php
use Migrations\AbstractMigration;
use Cake\Utility\Text;

class CreateSocialProvidersTable extends AbstractMigration
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
        $table = $this->table('social_providers');
        $table
            ->addColumn('name', 'string', [
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('selector', 'string', [
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('access', 'string', [
                'limit' => 255,
                'null' => false,
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
