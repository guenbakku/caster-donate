<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Utility\Text;
use Cake\Utility\Hash;
use MimeTyper\Repository\MimeDbRepository;

/**
 * Column behavior.
 * Manage columns' info of table
 */
class ColumnBehavior extends Behavior
{
    public function columnsExcept($excepts) {
        $columns = $this->_table->schema()->columns();
        $subtracted = array_filter($columns, function ($item) use ($excepts) {
            return !in_array($item, $excepts);
        });
        return $subtracted;
    }
}