<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class MultipleSelectCell extends Cell
{
    public function display($rootView, $transport, $input) 
    {
        $defaultTransport = [
            'read' => null,
        ];
        $defaultInput = [
            'name' => null,
            'value' => null,
            'id' => md5(uniqid()),
            'class' => '',
        ];
        
        $transport = array_merge($defaultTransport, $transport);
        $input = array_merge($defaultInput, $input);

        $this->set(compact('input', 'transport', 'rootView'));
    }
}