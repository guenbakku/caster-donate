<?php
use Migrations\AbstractMigration;

class CreateSexesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('sexes');
        $table
            ->addColumn('name', 'string',[
                'null' => false,
                'limit' => 20,
            ])
            ->addColumn('identify', 'string',[
                'null' => false,
                'limit' => 20,
            ])
            ->addColumn('order_no', 'integer',[
                'null' => true,
            ])
            ->addColumn('created', 'datetime',[
                'null' => false,
            ])
            ->addColumn('modified', 'datetime',[
                'null' => false,
            ])
            ->create();

        $rows = [
            [
                'id' => 1,
                'name' => 'Nam',
                'key' => 'male',
                'order_no' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Nữ',
                'key' => 'female',
                'order_no' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Khác',
                'key' => 'other',
                'order_no' => 3,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];
        $table->insert($rows)->saveData();
    }
}
