<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class DragDropAreaCell extends Cell
{
    protected static $count = 0;

    public function display($rootView, $fieldname = 'unknown', array $options = []){
        $firstCall = static::$count === 0;
        static::$count++;
        
        $this->set(compact( 'rootView', 'fieldname', 'options', 'firstCall'));
    }
}