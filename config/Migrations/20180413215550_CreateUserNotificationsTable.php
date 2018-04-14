<?php
use Migrations\AbstractMigration;

class CreateUserNotificationsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('user_notifications', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid')
            ->addColumn('title', 'string', [
                'limit' =>  256,
                'null' => false,
            ])
            ->addColumn('content', 'text', [
                'null' => false,
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
