<?php
use Cake\Core\Configure;
$this->Form->templates([
    'inputContainer' => '{{content}}',
]);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Register new user') ?></p>
        <?= $this->Form->create($user) ?>
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
                <?= $this->Form->input('email', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Email'),
                ]) ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
            <div class="form-group">
                <?php
                    if (Configure::read('Users.reCaptcha.registration')) {
                        echo $this->User->addReCaptcha();
                    }
                ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox icheck">
                            <?php
                            if (Configure::read('Users.Tos.required')) {
                                echo $this->Form->control('tos', [
                                    'type' => 'checkbox',
                                    'label' => __d('CakeDC/Users', 'Accept TOS conditions'),
                                    'required' => true
                                ]);
                            }
                            ?>
                        </div>
                    </div>
                </div>
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