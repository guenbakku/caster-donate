<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class DragDropAreaCell extends Cell
{
    public function display($rootView, $fieldname = 'unknown', array $options = []){
        $this->set(compact( 'rootView', 'fieldname', 'options'));
    }
}