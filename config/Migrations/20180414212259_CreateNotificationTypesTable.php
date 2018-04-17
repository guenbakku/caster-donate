<?php
use Migrations\AbstractMigration;

class CreateNotificationTypesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('notification_types');
        $table
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
            ])
            ->addColumn('selector', 'string', [
                'null' => false,
                'limit' => 64,
            ])
            ->addColumn('color_class', 'string', [
                'null' => false,
                'limit' => 64,
            ])
            ->addColumn('order_no', 'integer', [
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
