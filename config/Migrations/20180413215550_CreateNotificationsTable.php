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
            ->addColumn('title', 'string', [
                'limit' =>  256,
                'null' => false,
            ])
            ->addColumn('content', 'text', [
                'null' => false,
            ])
            ->addColumn('type_id', 'integer', [
                'limit' => 11,
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
