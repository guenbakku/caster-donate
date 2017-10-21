<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['default']);?>
    <?=$this->Form->create($profile, [
        'type' => 'put',
        'class' => 'form-horizontal',
    ]);?>
        <h4 class="m-t-0"><?= __('Thông tin cơ bản') ?></h4>
        <?= $this->Form->control('nickname', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Nickname')
            ],
        ]) ?>

        <?= $this->Form->control('firstname', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Họ và tên đệm')
            ],
        ]) ?>

        <?= $this->Form->control('lastname', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Tên')
            ],
        ]) ?>

        <?= $this->Form->control('sex', [
            'class' => 'form-control',
            'empty' => true,
            'options' => $this->Code->getList('sexes'),
            'label' => [
                'text' =>  __('Giới tính')
            ],
        ]) ?>

        <?= $this->Form->control('birthday', [
            'class' => 'form-control',
            'type'  => 'text',
            'data-mask' => "99/99/9999",
            'placeholder' => 'dd/mm/yyyy',
            'label' => [
                'text' =>  __('Ngày sinh')
            ],
        ]) ?>

        <?= $this->Form->control('location', [
            'class' => 'form-control',
            'type'  => 'text',
            'label' => [
                'text' =>  __('Nơi ở')
            ],
        ]) ?>

        <?= $this->Form->control('introduction', [
            'class' => 'form-control',
            'type'  => 'textarea',
            'rows'   => 3,
            'label' => [
                'text' =>  __('Lời giới thiệu')
            ],
        ]) ?>

        <hr>
        <h4 class="m-t-0"><?= __('Mạng xã hội') ?></h4>
        <?php foreach($profile->social_providers as $i => $socialProvider): ?>
        <div class="form-group">
            <?= $this->Form->control(sprintf('social_providers.%d.id', $i), [
                'type' => 'hidden',
                'templates' => [
                    'inputContainer' => '{{content}}',
                ]
            ]) ?>
            <?= $this->Form->control(sprintf('social_providers.%d._joinData.id', $i), [
                'type' => 'hidden',
                'templates' => [
                    'inputContainer' => '{{content}}',
                ]
            ]) ?>
            <?= $this->Form->control(sprintf('social_providers.%d._joinData.reference', $i), [
                'class' => 'form-control',
                'type' => 'text',
                'label' => [
                    'text' => __($socialProvider->name),
                ],
                'templates' => [
                    'inputContainer' => '{{content}}',
                    'formGroup' => '{{label}}<div class="col-sm-6">{{input}}</div>'
                ]
            ]) ?>
            <?= $this->Form->control(sprintf('social_providers.%d._joinData.public', $i), [
                'type' => 'checkbox',
                'label' => __('Công khai'),
                'hiddenField' => true,
            ]) ?>
        </div>
        <?php endforeach ?>
            
        <?= $this->Form->button( __('Cập nhật'),[
            'class' => 'btn btn-success',
            'label' => false,
            'type' => 'submit'
        ]) ?>

    <?= $this->Form->end() ?>
</div>
