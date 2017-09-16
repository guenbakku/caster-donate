<?php
use Migrations\AbstractMigration;

class CreateSessionTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('sessions', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'string', ['limit' => 40, 'null' => false])
              ->addColumn('data', 'text', ['null' => true])
              ->addColumn('expires', 'integer', ['null' => false])
              ->create();
    }
    
    public function down()
    {
        $this->dropTable('sessions');
    }
}
