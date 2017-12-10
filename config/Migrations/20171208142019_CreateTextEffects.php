<?php
use Migrations\AbstractMigration;

class CreateTextEffects extends AbstractMigration
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
        $table = $this->table('text_effects', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('selector', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('loop', 'integer', [
            'limit' => 1,
            'null' => true,
        ]);
        $table->addColumn('minDisplaytime', 'integer', [
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('initialDelay', 'integer', [
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('autoStart', 'integer', [
            'limit' => 1,
            'null' => false,
        ]);

        $table->addColumn('in_effect', 'string', [
            'limit' => 32,
            'null' => false,
        ]);
        $table->addColumn('in_delayScale', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('in_delay', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('in_sync', 'integer', [
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('in_shuffle', 'integer', [
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('in_reverse', 'integer', [
            'limit' => 1,
            'null' => false,
        ]);

        $table->addColumn('out_effect', 'string', [
            'limit' => 32,
            'null' => false,
        ]);
        $table->addColumn('out_delayScale', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('out_delay', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('out_sync', 'integer', [
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('out_shuffle', 'integer', [
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('out_reverse', 'integer', [
            'limit' => 1,
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
