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
            'preSelected' => null,
        ];
        $defaultInput = [
            'id' => md5(uniqid()),
            'name' => null,
            'value' => null,
            'class' => null,
            'label' => false,
        ];
        
        $transport = array_merge($defaultTransport, $transport);
        $input = array_merge($defaultInput, $input);

        $this->set(compact('input', 'transport', 'rootView'));
    }
}