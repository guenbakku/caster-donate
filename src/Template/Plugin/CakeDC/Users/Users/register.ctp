<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Register new user') ?></p>
        <?= $this->Form->create($user) ?>

            <?= $this->Form->input('username', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Username'),
                'templateVars' => ['glyphicon' => 'user'],
            ]) ?>

            <?= $this->Form->input('email', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Email'),
                'templateVars' => ['glyphicon' => 'envelope'],
            ]) ?>

            <?= $this->Form->input('password', [
                'required' => true, 
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Password'),
                'templateVars' => ['glyphicon' => 'lock'],
            ]) ?>

            <?= $this->Form->input('password_confirm', [
                'type' => 'password',
                'required' => true,
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Confirm password'),
                'templateVars' => ['glyphicon' => 'lock'],
            ]) ?>

            <div class="form-group">
                <?php if (Configure::read('Users.reCaptcha.registration')) {
                    echo $this->User->addReCaptcha();
                } ?>
            </div>
            
            <?php if (Configure::read('Users.Tos.required')) {
                    echo $this->Form->control('tos', [
                        'type' => 'checkbox',
                        'label' => __d('CakeDC/Users', 'Accept TOS conditions'),
                        'required' => true
                    ]);
                }
            ?>

            <?= $this->Form->button(__('Submit'), [
                'class' => 'btn btn-primary btn-block btn-flat',
            ]); ?>

        <?= $this->Form->end() ?>
    </div>
</div>