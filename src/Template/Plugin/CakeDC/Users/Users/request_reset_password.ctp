<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Reset password') ?></p>
        <p class="box-title"><?= __d('CakeDC/Users', 'Please enter your email to reset your password') ?></p>
        <?= $this->Form->create('User') ?>
            <?= $this->Form->input('reference', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Email'),
                'templateVars' => ['glyphicon' => 'envelope'],
            ]) ?>
            
            <?= $this->Form->button(__('Submit'), [
                'class' => 'btn btn-primary btn-block btn-flat',
            ]); ?>
            
        <?= $this->Form->end() ?>
    </div>
</div>