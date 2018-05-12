<?php
use Migrations\AbstractSeed;

class NotificationTemplatesSeed extends AbstractSeed
{    
    public function run()
    {
        /*
        * type_id: xem trong seed NotificationTypesSeed
        *        có: 1: Admin, 2: Hệ Thống, 3: Dòng tiền
        */
        $data = [
            //Template rỗng cho các nội dung mở rộng
            [
                'id' => 1,
                'selector' => 'adminEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '1',
                'order_no' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'selector' => 'systemEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '2',
                'order_no' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'selector' => 'moneyEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '3',
                'order_no' => 3,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'selector' => 'afterRegister',
                'template' => 'Chào mừng bạn đến với '. Cake\Core\Configure::read('System.sitename'),
                'link' => '',
                'type_id' => '3',
                'order_no' => 4,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('notification_templates');
        $table->truncate();
        $table->insert($data)->save();
    }
}
