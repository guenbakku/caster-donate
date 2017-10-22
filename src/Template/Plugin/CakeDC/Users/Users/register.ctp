<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>
<div class="col-md-offset-4 col-md-4">
    <div class="new-login-box">
        <div class="white-box">
            <h3 class="box-title m-b-0"><?=  __d('CakeDC/Users', 'Register new user') ?></h3>
            <small><?=__('Vui lòng điền thông tin tài khoản')?></small>
            <?= $this->Form->create($user,['class' => 'form-horizontal new-lg-form']) ?>
                <?= $this->Form->input('username', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Username'),
                    'templateVars' => ['glyphicon' => 'user','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
                ]) ?>

                <?= $this->Form->input('email', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Email'),
                    'templateVars' => ['glyphicon' => 'envelope','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
                ]) ?>

                <?= $this->Form->input('password', [
                    'required' => true, 
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Password'),
                    'templateVars' => ['glyphicon' => 'lock','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
                ]) ?>

                <?= $this->Form->input('password_confirm', [
                    'type' => 'password',
                    'required' => true,
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Confirm password'),
                    'templateVars' => ['glyphicon' => 'lock','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
                ]) ?>

                <div class="form-group">
                    <div class="col-md-12">
                        <?php if (Configure::read('Users.reCaptcha.registration')) {
                            echo $this->User->addReCaptcha();
                        } ?>
                    </div>
                </div>

                <?php if (Configure::read('Users.Tos.required')): ?>
                <div class="form-group">
                    <div class="col-md-12">
                        <?= $this->Form->control('tos', [
                            'type' => 'checkbox',
                            'label' => __d('CakeDC/Users', 'Accept TOS conditions'),
                            'required' => true
                        ]); ?>
                    </div>
                </div>
                <?php endif ?>

                <?= $this->Form->button(__('Submit'), [
                    'class' => 'btn btn-info btn-block btn-rounded text-uppercase waves-effect waves-light',
                ]); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>