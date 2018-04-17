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
                'id' => 1,
                'selector' => 'adminEmpty',
                'template' => '',
                'path' => '',
                'type_id' => '1',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'selector' => 'systemEmpty',
                'template' => '',
                'path' => '',
                'type_id' => '2',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'selector' => 'moneyEmpty',
                'template' => '',
                'path' => '',
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
