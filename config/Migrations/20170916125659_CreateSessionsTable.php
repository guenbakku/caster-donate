<?php
use Migrations\AbstractMigration;

class CreateSessionsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('sessions', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'string', ['limit' => 40, 'null' => false])
              ->addColumn('data', 'text', ['null' => true])
              ->addColumn('expires', 'integer', ['null' => false])
              ->create();
    }
}
