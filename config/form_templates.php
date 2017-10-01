<?php

/**
 * Define templates for form
 *
 * @package: App
 */
return [
    'FormTemplates' => [
        'default' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}}<div class="col-sm-10">{{input}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'file' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'dateWidget' => 'Ngày{{day}} Tháng{{month}} Năm{{year}}',
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            'button' => '<div class="form-group"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
            'label' => '<label class="col-sm-2 control-label" {{attrs}}>{{text}}</label>',
            
            'checkboxContainer' => '{{content}}',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'nestingLabel' => '<label{{attrs}}>{{text}}&nbsp;&nbsp;{{input}}</label>',
            'checkboxFormGroup' => '<div class="col-sm-4"><div class="checkbox icheck">{{label}}{{input}}</div></div>',
            
            'inputContainerError' => '<div class="form-group {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="col-sm-offset-2 help-block" style="padding:0 15px">{{content}}</div>',
            'errorList' => '<div>{{content}}</div>',
            'errorItem' => '<div>{{text}}</div>',
        ],

        'login' => [
            'inputContainer' => '<div class="form-group has-feedback">{{content}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} /><span class="glyphicon glyphicon-{{glyphicon}} form-control-feedback"></span>',
            
            'checkboxContainer' => '<div class="form-group"><div class="row">{{content}}</div></div>',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'nestingLabel' => '<label{{attrs}}>{{input}} {{text}}</label>',
            'checkboxFormGroup' => '<div class="col-xs-12"><div class="checkbox icheck">{{input}}{{label}}</div></div>',
            'button' => '<div class="form-group"><div class="row"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div></div>',
        ],
    ],
];