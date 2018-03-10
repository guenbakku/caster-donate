<?php
use Migrations\AbstractMigration;

class SeedResourcesTable extends AbstractMigration
{
    public function up()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Test 1',
                'filename' => '1.jpg',
                'resource_type_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('resources');
        $table->insert($data)->save();
    }
}
