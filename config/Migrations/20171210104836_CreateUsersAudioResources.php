<?php
use Migrations\AbstractMigration;

class CreateUsersAudioResources extends AbstractMigration
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
        $table = $this->table('users_audio_resources', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id','uuid',[
                'null' => false,
            ])
            ->addColumn('user_id','uuid',[
                'null' => false,
            ])
            ->addColumn('audio_id','uuid',[
                'null' => false,
            ])
            ->addColumn('created','datetime',[
                'null' => false,
            ])
            ->addColumn('modified','datetime',[
                'null' => false,
            ])
            ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'))
            ->addForeignKey('audio_id', 'audio_resources', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'))
            ->create();
    }
}
