<?php
use Cake\Core\Configure;
$this->Form->templates([
    'inputContainer' => '{{content}}',
]);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Sign in to start your session') ?></p>
        <?= $this->Form->create() ?>
            <div class="form-group has-feedback">
                <?= $this->Form->input('username', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Username'),
                ]) ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= $this->Form->input('password', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Password'),
                ]) ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group">
                <?php 
                    if (Configure::read('Users.reCaptcha.login')) {
                        echo $this->User->addReCaptcha();
                    }
                ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="checkbox icheck">
                            <?php
                            if (Configure::read('Users.RememberMe.active')) {
                                echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                                    'type' => 'checkbox',
                                    'label' => __d('CakeDC/Users', 'Remember me'),
                                    'checked' => Configure::read('Users.RememberMe.checked'),
                                ]);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <?= $this->Form->button(__d('CakeDC/Users', 'Login'), [
                            'class' => 'btn btn-primary btn-block btn-flat',
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <?php if (Configure::read('Users.Registration.active')): ?>
                        <?= $this->Html->link(__d('CakeDC/Users', 'Register'), ['action' => 'register']) ?>
                    <?php endif ?>
                    <?php if (Configure::read('Users.Email.required')): ?>
                        <?= Configure::read('Users.Registration.active')? ' | ' : '' ?>
                        <?= $this->Html->link(__d('CakeDC/Users', 'Forgot password?'), ['action' => 'requestResetPassword']) ?>
                    <?php endif ?>
                </div>
            </div>
            <?= implode(' ', $this->User->socialLoginList()); ?>
        <?= $this->Form->end() ?>
    </div>
    <!-- /.login-box-body -->
</div>