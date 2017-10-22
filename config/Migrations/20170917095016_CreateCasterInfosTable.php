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
            ->addColumn('contracted', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('donate_image', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('donate_audio', 'string', [
                'null' => true,
                'limit' => 128,
            ])
            ->addColumn('donate_link', 'string', [
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
