<?php
use Cake\Core\Configure;
$this->Form->templates([
    'inputContainer' => '{{content}}',
]);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Reset password') ?></p>
        <p class="box-title"><?= __d('CakeDC/Users', 'Please enter your email to reset your password') ?></p>
        <?= $this->Form->create('User') ?>
            <div class="form-group has-feedback">
                <?= $this->Form->input('reference', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Email'),
                ]) ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?= $this->Form->button(__('Submit'), [
                        'class' => 'btn btn-primary btn-block btn-flat',
                    ]); ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>