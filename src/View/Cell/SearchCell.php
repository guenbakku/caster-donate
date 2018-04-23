<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class SearchCell extends Cell
{
    public function display($rootView, $transport, $input, $select2Option = [], $resultLayout = []) 
    {
        $defaultTransport = [
            'read' => null,//nguồn tìm kiếm
            'preSelected' => null,//những select đã được chọn từ trước
            'jump' => null,//click vào kết quả tìm kiếm để chuyển trang
        ];
        $defaultInput = [
            'id' => md5(uniqid()),
            'name' => null,
            'value' => null,
            'class' => null,
            'label' => false,
        ];
        $defaultSelect2Option = [];
        $defaultResultLayout = [
            'templateResult' => null,
        ];
        
        $transport = array_merge($defaultTransport, $transport);
        $input = array_merge($defaultInput, $input);
        $select2Option = array_merge($defaultSelect2Option, $select2Option);
        $resultLayout = array_merge($defaultResultLayout, $resultLayout);

        $this->set(compact('input', 'transport', 'rootView', 'select2Option', 'resultLayout'));
    }
}