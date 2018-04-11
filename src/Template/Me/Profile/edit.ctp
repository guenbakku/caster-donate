<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <?=$this->Form->create($profile, [
        'type' => 'put',
        'class' => 'form-horizontal',
    ]);?>
        <h4 class="m-t-0"><?= __('Thông tin cơ bản') ?></h4>
        <?= $this->Form->control('nickname', [
            'class' => 'form-control',
            'label' => __('Nickname'),
        ]) ?>

        <?= $this->Form->control('introduction', [
            'class' => 'form-control',
            'type'  => 'textarea',
            'rows'  => 3,
            'label' => __('Lời giới thiệu'),
        ]) ?>

        <hr>
        <h4 class="m-t-0"><?= __('Mạng xã hội') ?></h4>
        <?php foreach($profile->social_providers as $i => $socialProvider): ?>
        <div class="form-group">
            <?= $this->Form->hidden(sprintf('social_providers.%d.id', $i)) ?>
            <?= $this->Form->control(sprintf('social_providers.%d._joinData.id', $i)) ?>
            <?= $this->Form->control(sprintf('social_providers.%d._joinData.reference', $i), [
                'class' => 'form-control',
                'type' => 'text',
                'label' => __($socialProvider->name),
                'templates' => [
                    'inputContainer' => '{{content}}',
                    'formGroup' => '<div class="col-sm-2 control-label">{{label}}</div><div class="col-sm-6">{{input}}</div>'
                ],
            ]) ?>
            <?= $this->Form->control(sprintf('social_providers.%d._joinData.public', $i), [
                'type' => 'checkbox',
                'label' => __('Công khai'),
                'hiddenField' => true,
            ]) ?>
        </div>
        <?php endforeach ?>
        
        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Form->button( __('Gửi'),[
                    'class' => 'btn btn-success miw-100',
                    'label' => false,
                    'type' => 'submit'
                ]) ?>
            </div>
        </div>

    <?= $this->Form->end() ?>
</div>
