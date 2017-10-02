<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=  __d('CakeDC/Users', 'Change password') ?></p>
        <p class="box-title"><?= __d('CakeDC/Users', 'Please enter the new password') ?></p>
        <?= $this->Form->create($user) ?>

            <?php if ($validatePassword): ?>
                <?= $this->Form->input('current_password', [
                    'type' => 'password',
                    'required' => true,
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => __d('CakeDC/Users', 'Current password'),
                    'templateVars' => ['glyphicon' => 'lock'],
                ]) ?>
            <?php endif ?>

            <?= $this->Form->input('password', [
                'type' => 'password',
                'required' => true,
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'New password'),
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

            <?= $this->Form->button(__('Submit'), [
                'class' => 'btn btn-primary btn-block btn-flat',
            ]); ?>

        <?= $this->Form->end() ?>
    </div>
</div>