<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <?= $this->Form->create($user, [
        'type' => 'put',
        'class' => 'form-horizontal',
    ]) ?>
        <?= $this->Form->input('password', [
            'class' => 'form-control',
            'type' => 'password',
            'label' => [
                'text' => __d('CakeDC/Users', 'New password'),
                'class' => 'required',
            ],
            'required' => true,
        ]) ?>

        <?= $this->Form->input('password_confirm', [
            'class' => 'form-control',
            'type' => 'password',
            'label' => [
                'text' => __d('CakeDC/Users', 'Confirm password'),
                'class' => 'required',
            ],
            'required' => true,
        ]) ?>

        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Form->button(__('Lưu'), [
                    'class' => 'fcbtn btn btn-outline btn-success miw-100',
                ]); ?>
            </div>
        </div>

    <?= $this->Form->end() ?>
</div>
