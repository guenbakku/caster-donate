<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class DragDropAreaCell extends Cell
{
    public function display($rootView, $fieldname = 'unknown', $id = ''){
        $this->set(compact( 'rootView', 'fieldname', 'id'));
    }
}