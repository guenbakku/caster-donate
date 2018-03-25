<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class UploadResourceCell extends Cell
{
    public function display($rootView, $settings)
    {
        $defaultSettings = [
            'button_text' => __('Thêm file mới'),
            'file_type_id' => 'image',
            'drag_drop_area_id'  =>  'default_id',
            'callBackFunction' =>   ''
        ];
        
        $this->resourcesTb = TableRegistry::get('resources');
        $resource = $this->resourcesTb->newEntity();

        $settings = array_merge($defaultSettings, $settings);

        $this->set(compact('rootView', 'settings', 'resource'));
    }
}