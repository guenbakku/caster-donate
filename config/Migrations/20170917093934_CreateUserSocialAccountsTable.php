<?php
use Migrations\AbstractMigration;

class CreateUserSocialAccountsTable extends AbstractMigration
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
        $table = $this->table('user_social_accounts', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('provider_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('reference', 'string', [
                'null' => false,
                'limit' => 255,
            ])
            ->addColumn('public', 'boolean', [
                'null' => false,
                'default' => 0,
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
