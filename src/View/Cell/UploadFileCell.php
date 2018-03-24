<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class UploadFileCell extends Cell
{
    public function display($rootView, $setting)
    {
       
        $defaultSetting = [
            'button_text' => __('Thêm file mới'),
            'file_type_id' => 'image',
            'drag_drop_area_id'  =>  'default_id',
            'callBackFunction' =>   ''
        ];
        
        $this->resourcesTb = TableRegistry::get('resources');
        $resource = $this->resourcesTb->newEntity();

        $setting = array_merge($defaultSetting, $setting);

        $this->set(compact( 'rootView','setting','resource'));
    }
}