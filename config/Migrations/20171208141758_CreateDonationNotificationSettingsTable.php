<?php
use Migrations\AbstractMigration;

class CreateDonationNotificationSettingsTable extends AbstractMigration
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
        $table = $this->table('donation_notification_settings', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('user_id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('notify_message_array', 'string', [
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('audio_id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('image_id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('text_color_1', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('text_color_2', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('appear_effect', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('disappear_effect', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('display_time', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
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
