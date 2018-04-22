<?php

/**
 * Define templates for form
 *
 * @package: App
 */
return [
    'FormTemplates' => [
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