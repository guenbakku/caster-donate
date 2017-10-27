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
            'formGroup' => '<div class="col-md-2 control-label">{{label}}</div><div class="col-md-10">{{input}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            'file' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'dateWidget' => 'Ngày{{day}} Tháng{{month}} Năm{{year}}',
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            'button' => '<button name="{{name}}"{{attrs}}>{{text}}</button>',
            'label' => '<label {{attrs}}>{{text}}</label>',
            
            'checkboxContainer' => '<div class="col-sm-4"><div class="checkbox checkbox-info">{{content}}</div></div>',
            'checkboxFormGroup' => '{{input}}{{label}}',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'nestingLabel' => '{{input}}<label{{attrs}}> {{text}}</label>',
            
            'inputContainerError' => '<div class="form-group {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="col-md-offset-2 help-block">{{content}}</div>',
            'errorList' => '<div>{{content}}</div>',
            'errorItem' => '<div>{{text}}</div>',
        ],

        'input-short' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '<div class="col-md-2 control-label">{{label}}</div><div class="col-md-6">{{input}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            'file' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            'button' => '<button name="{{name}}"{{attrs}}>{{text}}</button>',
            'label' => '<label {{attrs}}>{{text}}</label>',
            
            'checkboxContainer' => '<div class="col-sm-4"><div class="checkbox checkbox-info">{{content}}</div></div>',
            'checkboxFormGroup' => '{{input}}{{label}}',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'nestingLabel' => '{{input}}<label{{attrs}}> {{text}}</label>',
            
            'inputContainerError' => '<div class="form-group {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="col-md-offset-2 help-block">{{content}}</div>',
            'errorList' => '<div>{{content}}</div>',
            'errorItem' => '<div>{{text}}</div>',
        ],

        'vertical' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}}<div class="col-md-12">{{input}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            'file' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            'button' => '<button name="{{name}}"{{attrs}}>{{text}}</button>',
            'label' => '<label class="col-md-12 control-label" {{attrs}}>{{text}}</label>',
            
            'checkboxContainer' => '<div class="col-sm-4"><div class="checkbox checkbox-info">{{content}}</div></div>',
            'checkboxFormGroup' => '{{input}}{{label}}',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'nestingLabel' => '{{input}}<label{{attrs}}> {{text}}</label>',
            
            'inputContainerError' => '<div class="form-group {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="help-block">{{content}}</div>',
            'errorList' => '<div>{{content}}</div>',
            'errorItem' => '<div>{{text}}</div>',
        ],

        'tag' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}}{{input}}',
            'label' => '<label class="control-label" {{attrs}}>{{text}}</label>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            'button' => '<div class="row"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
        ],

        'login' => [
            'inputContainer' => '<div class="form-group has-feedback {{WrapperDivClass}}"><div class="{{InputDivClass}}">{{content}}</div></div>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} /><span class="glyphicon glyphicon-{{glyphicon}} form-control-feedback"></span>',
            
            'checkboxContainer' => '<div class="checkbox checkbox-info pull-left p-t-0">{{content}}</div>',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'nestingLabel' => '{{input}}<label{{attrs}}> {{text}}</label>',
            'checkboxFormGroup' => '{{input}}{{label}}',
            'button' => '<div class="form-group text-center m-t-20"><div class="col-xs-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
        ],
    ],
];