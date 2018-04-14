<?php
use Migrations\AbstractSeed;

class NotificationTypesSeed extends AbstractSeed
{    
    public function run()
    {
        /*
        * color_class có thể là danger, success, info, warning, primary, default
        */
        $data = [
            [
                'id' => 1,
                'name' => 'Hệ thống',
                'selector' => 'system',
                'color_class' => 'default',
                'order_no' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'selector' => 'admin',
                'color_class' => 'danger',
                'order_no' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Dòng tiền',
                'selector' => 'money',
                'color_class' => 'success',
                'order_no' => 3,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('notification_types');
        $table->truncate();
        $table->insert($data)->save();
    }
}
