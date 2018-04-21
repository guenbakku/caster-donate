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
                'id' => 'notifica-tion-empt-y000-000000000001',
                'selector' => 'adminEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '1',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 'notifica-tion-empt-y000-0000-000000000002',
                'selector' => 'systemEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '2',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 'notifica-tion-empt-y000-0000-000000000003',
                'selector' => 'moneyEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '3',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 'notifica-tion-syst-em00-0000-000000000001',
                'selector' => 'afterRegister',
                'template' => 'Chào mừng bạn đến với '. Cake\Core\Configure::read('System.sitename'),
                'link' => '',
                'type_id' => '3',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('notification_templates');
        $table->truncate();
        $table->insert($data)->save();
    }
}
