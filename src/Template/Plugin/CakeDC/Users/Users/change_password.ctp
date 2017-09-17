<?php
use Cake\Core\Configure;
$this->Form->templates([
    'inputContainer' => '{{content}}',
]);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Change password') ?></p>
        <p class="box-title"><?= __d('CakeDC/Users', 'Please enter the new password') ?></p>
        <?= $this->Form->create($user) ?>
            <div class="form-group has-feedback">
                <?php if ($validatePassword): ?>
                    <?= $this->Form->input('current_password', [
                        'type' => 'password',
                        'required' => true,
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => __d('CakeDC/Users', 'Current password'),
                    ]) ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php endif ?>
            </div>
            <div class="form-group has-feedback">
                <?= $this->Form->input('password', [
                    'type' => 'password',
                    'required' => true,
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'New password'),
                ]) ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= $this->Form->input('password_confirm', [
                    'type' => 'password',
                    'required' => true,
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Confirm password'),
                ]) ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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