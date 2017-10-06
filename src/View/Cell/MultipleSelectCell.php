<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class MultipleSelectCell extends Cell
{
    public function display($rootView, $options) 
    {
        $id = md5(uniqid());
        $this->set(compact('options', 'rootView', 'id'));
    }
}