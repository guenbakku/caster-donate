<?php
use Migrations\AbstractMigration;

class AddLocationToUserInfosTable extends AbstractMigration
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
        $table = $this->table('user_infos');
        $table->addColumn('location', 'string', [
            'after' => 'birthday',
            'limit' => 100,
            'null' => true,
        ])->update();
    }
}
