<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <?= $this->Form->create($user, [
        'type' => 'put',
        'class' => 'form-horizontal',
    ]) ?>
        <?= $this->Form->input('email', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Địa chỉ email'),
                'class' => 'required',
            ],
            'required' => true,
        ]) ?>

        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Form->button(__('Submit'), [
                    'class' => 'fcbtn btn btn-outline btn-success miw-100',
                ]); ?>
            </div>
        </div>

    <?= $this->Form->end() ?>
</div>
