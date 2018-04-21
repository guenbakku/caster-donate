<?php
use Migrations\AbstractMigration;

class CreateNotificationTemplatesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('notification_templates', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
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
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ])
            ->create();
    }
}
