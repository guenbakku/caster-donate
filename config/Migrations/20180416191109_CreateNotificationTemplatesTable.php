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
            ->addColumn('title', 'string', [
                'null' => false,
                'limit' => 512
            ])
            ->addColumn('content_template', 'string', [
                'limit' => 512,
                'null' => true,
            ])
            ->addColumn('content_extend_id', 'uuid', [
                'null' => true,
            ])
            ->addColumn('type_id', 'integer', [
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
