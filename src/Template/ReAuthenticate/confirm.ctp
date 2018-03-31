<?php
use Cake\Core\Configure;
$this->Form->templates($FormTemplates['login']);
?>

<div class="new-login-box">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=  __('Xác thực') ?></h3>
        <small><?=__('Vui lòng nhập mật khẩu hiện tại để tiếp tục')?></small>
        <?= $this->Form->create(null, ['class' => 'form-horizontal new-lg-form']) ?>
            <?= $this->Form->input('current_password', [
                'required' => true, 
                'label' => false,
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => __d('CakeDC/Users', 'Password'),
                'templateVars' => ['glyphicon' => 'lock', 'WrapperDivClass' => 'm-t-20', 'InputDivClass' => 'col-xs-12'],
            ]) ?>
        
            <?= $this->Form->button(__('Tiếp tục'), [
                'class' => 'btn btn-info btn-block btn-rounded text-uppercase waves-effect waves-light',
            ]) ?>

            <div class="form-group m-b-0 text-center">
                <a href="javascript:history.back();" class="m-l-5"><?= __('Quay lại') ?></a>
            </div>
            
        <?= $this->Form->end() ?>
    </div>
</div>"
