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
                'null' => false,
                'default' => null
            ])
            ->addColumn('template_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('extend_id', 'uuid', [
                'null' => true,
                'default' => null
            ])
            ->addColumn('vars', 'text', [
                'null' => false,
            ])
            ->addColumn('seen', 'datetime', [
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
