<?php
use Migrations\AbstractSeed;

/**
 * ResourceTypes seed.
 */
class ResourceFeaturesSeed extends AbstractSeed
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
                'name' => 'Thiết lập thông báo donate',
                'selector' => 'donation_notification',
                'order_no' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('resource_features');
        $table->truncate();
        $table->insert($data)->save();
    }
}
