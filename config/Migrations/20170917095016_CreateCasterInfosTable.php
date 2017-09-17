<?php
use Migrations\AbstractMigration;

class CreateCasterInfosTable extends AbstractMigration
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
        $table = $this->table('caster_infos', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('identify_card', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('contract', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('donate_image', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('donate_audio', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('phone', 'string', [
                'null' => true,
                'limit' => 60,
            ])
            ->addColumn('bank_name', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('bank_branch', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('bank_account_number', 'string', [
                'null' => true,
                'limit' => 255,
            ])
            ->addColumn('bank_account_holder', 'string', [
                'null' => true,
                'limit' => 255,
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
