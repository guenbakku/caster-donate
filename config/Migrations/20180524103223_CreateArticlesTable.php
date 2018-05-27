<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateArticlesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('articles', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ])
        ->addColumn('user_id', 'uuid', [
            'null' => false,
        ])
        ->addColumn('title', 'string', [
            'limit' => '512',
            'null' => false,
        ])
        ->addColumn('content', 'text', [
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }
}
