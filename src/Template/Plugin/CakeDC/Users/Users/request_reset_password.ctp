<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="col-md-offset-4 col-md-4">
    <div class="new-login-box">
        <div class="white-box">
            <h3 class="box-title m-b-0"><?=  __d('CakeDC/Users', 'Reset password') ?></h3>
            <small><?= __d('CakeDC/Users', 'Please enter your email to reset your password') ?></small>
            <?= $this->Form->create('User',['class' => 'form-horizontal new-lg-form']) ?>
                <?= $this->Form->input('reference', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Email'),
                    'templateVars' => ['glyphicon' => 'envelope','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
                ]) ?>
                
                <?= $this->Form->button(__('Submit'), [
                    'class' => 'btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light',
                ]); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>