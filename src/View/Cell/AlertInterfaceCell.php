<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class AlertInterfaceCell extends Cell
{
    public function alertDonate($rootView){
        $this->set(compact( 'rootView'));
    }
}