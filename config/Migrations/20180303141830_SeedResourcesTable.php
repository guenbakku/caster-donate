<?php
use Migrations\AbstractMigration;

class SeedResourcesTable extends AbstractMigration
{
    public function up()
    {
        $data = [
            //image
            [            
                'id' => 'resource-0000-0000-0img-public000001',
                'name' => 'Test 1',
                'filename' => 'public/1.jpg',
                'resource_type_id' => 1,
                'resource_feature_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],

            //audio
            [            
                'id' => 'resource-0000-000a-udio-public000001',
                'name' => 'Test 1',
                'filename' => 'public/test1.mp3',
                'resource_type_id' => 2,
                'resource_feature_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('resources');
        $table->insert($data)->save();
    }
}
