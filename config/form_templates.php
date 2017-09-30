<?php

/**
 * Define templates for form
 */
return [
    'FormTemplates' => [
        'default' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'input' => '<div class="col-sm-10"><input type="{{type}}" name="{{name}}" {{attrs}} /></div>',
            'file' => '<div class="col-sm-10"><input type="{{type}}" name="{{name}}" {{attrs}} /></div>',
            'dateWidget' => '<div class="col-sm-10">Ngày{{day}} Tháng{{month}} Năm{{year}}</div>',
            'textarea' => '<div class="col-sm-10"><textarea name="{{name}}"{{attrs}}>{{value}}</textarea></div>',
            'button' => '<div class="form-group"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
            'label' => '<label class="col-sm-2 control-label" {{attrs}}>{{text}}</label>',
        ],
    ],
];