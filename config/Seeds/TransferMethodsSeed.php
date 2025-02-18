<?php
use Migrations\AbstractSeed;

/**
 * SocialProvider seed.
 */
class TransferMethodsSeed extends AbstractSeed
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
                'name' => 'Xu',
                'selector' => 'Coin',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Ngân Lượng - ATM',
                'selector' => 'NL-AtmCard',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Ngân Lượng - Credit Card',
                'selector' => 'NL-CreditCard',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'Ngân Lượng - Thẻ Cào',
                'selector' => 'NL-PhoneCard',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'name' => 'Momo',
                'selector' => 'Momo',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('transfer_methods');
        $table->truncate();
        $table->insert($data)->save();
    }
}
