<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="new-login-box">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=  __d('CakeDC/Users', 'Change password') ?></h3>
        <small><?= __d('CakeDC/Users', 'Please enter the new password') ?></small>
        <?= $this->Form->create($user,['class' => 'form-horizontal new-lg-form']) ?>
            <?php if ($validatePassword): ?>
            <?= $this->Form->input('current_password', [
                'type' => 'password',
                'required' => true,
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Current password'),
                'templateVars' => ['glyphicon' => 'lock','WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
                ]) ?>
            <?php endif ?>

            <?= $this->Form->input('password', [
                'type' => 'password',
                'required' => true,
                'label' => false,
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'New password'),
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

            <?= $this->Form->button(__('Submit'), [
                'class' => 'btn btn-info btn-block btn-rounded text-uppercase waves-effect waves-light',
            ]); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
