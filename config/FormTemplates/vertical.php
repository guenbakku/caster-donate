<?php

/**
 * Define templates for form
 *
 * @package: App
 */
return [
    'FormTemplates' => [
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
    ],
];