<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <?= $this->Form->create($user, [
        'type' => 'put',
        'class' => 'form-horizontal',
    ]) ?>
        <?= $this->Form->input('password', [
            'class' => 'form-control',
            'type' => 'password',
            'label' => __d('CakeDC/Users', 'New password'),
            'required' => true,
        ]) ?>

        <?= $this->Form->input('password_confirm', [
            'class' => 'form-control',
            'type' => 'password',
            'label' => __d('CakeDC/Users', 'Confirm password'),
            'required' => true,
        ]) ?>

        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Form->button(__('Submit'), [
                    'class' => 'btn btn-success miw-100',
                ]); ?>
            </div>
        </div>

    <?= $this->Form->end() ?>
</div>
