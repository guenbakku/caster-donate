<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Utility\Hash;

/**
 * Column behavior.
 * Manage columns' info of table
 */
class ColumnBehavior extends Behavior
{
    /**
     * Return list of all columns of table except provided items.
     * Useful when use with fieldList in pathEntity, etc...
     */
    public function columnsExcept(array $excepts) {
        $columns = $this->_table->schema()->columns();
        $subtracted = array_filter($columns, function ($item) use ($excepts) {
            return !in_array($item, $excepts);
        });
        return $subtracted;
    }

    /**
     * Return length of provided column
     * Useful when validate maxLength of input
     */
    public function columnLength(string $name) {
        $column = $this->_table->schema()->column($name);
        return $column['length'];
    }
}