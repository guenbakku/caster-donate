<?php

/**
 * Define templates for form
 *
 * @package: App
 */
return [
    'FormTemplates' => [
        'tag' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}}{{input}}',
            'label' => '<label class="control-label" {{attrs}}>{{text}}</label>',
            'input' => '<input type="{{type}}" name="{{name}}" {{attrs}} />',
            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            'button' => '<div class="row"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
        ],
    ],
];