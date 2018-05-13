<?php
use Migrations\AbstractMigration;

class CreateNotificationTemplatesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('notification_templates');
        $table
            ->addColumn('selector', 'string', [
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('template', 'string', [
                'limit' => 512,
                'null' => false,
            ])
            ->addColumn('link', 'string', [
                'limit' => 256,
                'null' => false,
            ])
            ->addColumn('type_id', 'integer', [
                'null' => false
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
