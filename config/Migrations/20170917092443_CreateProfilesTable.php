<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateProfilesTable extends AbstractMigration
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
        $table = $this->table('profiles', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('nickname', 'string', [
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
            ->addColumn('sex_id', 'integer', [
                'null' => true,
            ])
            ->addColumn('birthday', 'date', [
                'null' => true,
            ])
            ->addColumn('location', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('introduction', 'string', [
                'null' => true,
                'limit' => 512,
            ])
            ->addColumn('avatar', 'string', [
                'null' => true,
                'limit' => 128,
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
