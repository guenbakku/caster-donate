<?php
use Migrations\AbstractSeed;

/**
 * Resources seed.
 */
class ResourcesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Test 1',
                'filename' => '1.jpg',
                'resource_type_id' => '1',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('resources');
        $table->truncate();
        $table->insert($data)->save();
    }
}
