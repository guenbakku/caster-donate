<?php
use Migrations\AbstractMigration;

class CreateNotificationsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('notifications', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => true,
                'default' => null
            ])
            ->addColumn('template_id', 'uuid', [
                'null' => true,
                'default' => null
            ])
            ->addColumn('vars', 'string', [
                'limit' => 512,
                'null' => false,
            ])
            ->addColumn('seen', 'boolean', [
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
