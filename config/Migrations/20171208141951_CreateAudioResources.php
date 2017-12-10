<?php
use Migrations\AbstractMigration;

class CreateAudioResources extends AbstractMigration
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
        $table = $this->table('audio_resources', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('private', 'integer', [
            'limit' => 1,
            'null' => true,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 128,
            'null' => true,
        ]);
        $table->addColumn('url', 'string', [
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('order_no', 'integer', [
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }
}
