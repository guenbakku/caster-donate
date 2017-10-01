<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Sign in to start your session') ?></p>
        <?= $this->Form->create() ?>
            <?= $this->Form->input('username', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Username'),
                'templateVars' => ['glyphicon' => 'user'],
            ]) ?>
                
            <?= $this->Form->input('password', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Password'),
                'templateVars' => ['glyphicon' => 'lock'],
            ]) ?>

            <div class="form-group">
                <?php if (Configure::read('Users.reCaptcha.login')) {
                    echo $this->User->addReCaptcha();
                } ?>
            </div>

            <?php if (Configure::read('Users.RememberMe.active')) {
                echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                    'type' => 'checkbox',
                    'label' => __d('CakeDC/Users', 'Remember me'),
                    'checked' => Configure::read('Users.RememberMe.checked'),
                    'hiddenField' => true,
                ]);
            } ?>
 
            <?= $this->Form->button(__d('CakeDC/Users', 'Login'), [
                'class' => 'btn btn-primary btn-block btn-flat',
            ]) ?>

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