<?php
use Migrations\AbstractMigration;

class CreateSchedulesTable extends AbstractMigration
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
        $table = $this->table('schedules', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('start', 'datetime', [
                'null' => true,
            ])
            ->addColumn('end', 'datetime', [
                'null' => true,
            ])
            ->addColumn('bg_color', 'string', [
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ])
            ->create();
    }
}
