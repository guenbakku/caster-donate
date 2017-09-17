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
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <?php
                        if (Configure::read('Users.reCaptcha.login')) {
                            echo $this->User->addReCaptcha();
                        }
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
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= $this->Form->button(__d('CakeDC/Users', 'Login'), [
                        'class' => 'btn btn-primary btn-block btn-flat',
                    ]); ?>
                </div>
                <!-- /.col -->
            </div>
            <?= implode(' ', $this->User->socialLoginList()); ?>
        <?= $this->Form->end() ?>
        <?php
        $registrationActive = Configure::read('Users.Registration.active');
        if ($registrationActive) {
            echo $this->Html->link(__d('CakeDC/Users', 'Register'), ['action' => 'register']);
        }
        if (Configure::read('Users.Email.required')) {
            if ($registrationActive) {
                echo '<br>';
            }
            echo $this->Html->link(__d('CakeDC/Users', 'Reset Password'), ['action' => 'requestResetPassword']);
        }
        ?>
    </div>
    <!-- /.login-box-body -->
</div>