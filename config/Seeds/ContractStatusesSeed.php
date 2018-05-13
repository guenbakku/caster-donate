<?php
use Migrations\AbstractSeed;

/**
 * ContractStatuses seed.
 */
class ContractStatusesSeed extends AbstractSeed
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
                'name' => 'Chưa đăng ký',
                'selector' => 'unregistered',
                'order_no' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Đang kiểm tra',
                'selector' => 'checking',
                'order_no' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Hợp lệ',
                'selector' => 'valid',
                'order_no' => 3,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'Cần bổ sung',
                'selector' => 'inadequacy',
                'order_no' => 4,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'name' => 'Đình chỉ',
                'selector' => 'suspended',
                'order_no' => 5,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('contract_statuses');
        $table->truncate();
        $table->insert($data)->save();
    }
}
