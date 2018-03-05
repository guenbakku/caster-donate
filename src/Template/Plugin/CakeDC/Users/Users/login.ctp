<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="new-login-box">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=  __d('CakeDC/Users', 'Sign in to start your session') ?></h3>
        <small><?=__('Vui lòng điền thông tin tài khoản')?></small>
        <?= $this->Form->create(null,['class' => 'form-horizontal new-lg-form']) ?>
            <?= $this->Form->input('username', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Username or email'),
                'templateVars' => ['glyphicon' => 'user','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
            ]) ?>
            <?= $this->Form->input('password', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Password'),
                'templateVars' => ['glyphicon' => 'lock', 'InputDivClass' => 'col-xs-12'],
            ]) ?>
            <div class="form-group">
                <div class="col-md-6">
                    <?php if (Configure::read('Users.RememberMe.active')) {
                        echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                            'type' => 'checkbox',
                            'label' => __d('CakeDC/Users', 'Remember me'),
                            'checked' => Configure::read('Users.RememberMe.checked'),
                            'hiddenField' => true,
                        ]);
                    }?>
                </div>
                <div class="col-md-6">
                    <?php if (Configure::read('Users.Email.required')): ?>
                        <?= Configure::read('Users.Registration.active')? '' : '' ?>
                        <?= $this->Html->link(__d('CakeDC/Users', 'Forgot password?'), 
                            ['action' => 'requestResetPassword'],
                            ['class' => 'pull-right']
                        ) ?>
                    <?php endif ?>
                </div>
            </div>
            <?= $this->Form->button(__d('CakeDC/Users', 'Login'), [
                'class' => 'btn btn-info btn-block btn-rounded text-uppercase waves-effect waves-light',
            ]) ?>
            <div class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10">
                    <div class="social-login text-center">
                        <a href="/auth/facebook" class="btn btn-facebook waves-effect waves-light" style="width: 250px">
                            <i aria-hidden="true" class="fa fa-facebook"></i> <?= __('Đăng nhập bằng Facebook') ?>
                        </a>
                        <a href="/auth/google" class="btn btn-googleplus waves-effect waves-light" style="width: 250px">
                            <i aria-hidden="true" class="fa fa-google-plus"></i> <?= __('Đăng nhập bằng Google') ?>
                        </a> 
                    </div>
                </div>
            </div>
            <?php if (Configure::read('Users.Registration.active')): ?>
                <div class="form-group m-b-0 text-center">
                    <?= __d('CakeDC/Users', 'Don\'t have an account?') ?>
                    <?= $this->Html->link(__d('CakeDC/Users', 'Register'), 
                        ['action' => 'register'],
                        ['class' => 'm-l-5']
                    ) ?>
                </div>
            <?php endif ?>
        <?= $this->Form->end() ?>
    </div>
</div>
