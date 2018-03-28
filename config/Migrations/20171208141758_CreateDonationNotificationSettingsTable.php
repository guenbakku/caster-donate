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
        $table->addColumn('notify_message', 'string', [
            'limit' => 128,
            'null' => true,
        ]);
        $table->addColumn('audio_id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('image_id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('text_color1', 'integer', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('text_color2', 'string', [
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
