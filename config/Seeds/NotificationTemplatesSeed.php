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
            [
                'id' => '00000000-0000-0000-0000-000000000001',
                'selector' => 'adminEmpty',
                'template' => 'Test chơi 1 phát thì sao {username}',
                'link' => '',
                'type_id' => '1',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '00000000-0000-0000-0000-000000000002',
                'selector' => 'systemEmpty',
                'template' => 'Test chơi 2 phát luôn',
                'link' => '',
                'type_id' => '2',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '00000000-0000-0000-0000-000000000003',
                'selector' => 'moneyEmpty',
                'template' => '',
                'link' => '',
                'type_id' => '3',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('notification_templates');
        $table->truncate();
        $table->insert($data)->save();
    }
}
