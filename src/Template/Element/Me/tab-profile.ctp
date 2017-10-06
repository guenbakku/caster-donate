<div class="tab-pane active" id="profile">
    <?php $this->Form->setTemplates($FormTemplates['default']);?>
    <?=$this->Form->create($profile, [
        'type' => 'file',
        'class' => 'form-horizontal',
    ]);?>
        <h4><?= __('Thông tin cơ bản') ?></h4>
        <?= $this->Form->control('avatar', [
            'class' => 'form-control',
            'templateVars' => [
                'type' => 'file'
            ],
            'type' => 'file',
            'label' => [
                'text' =>  __('Ảnh đại diện')
            ],
        ]) ?>

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

        <?= $this->Form->control('birthday', [
            'class' => 'form-control dateinput',
            'type'  => 'text',
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
        <h4><?= __('Mạng xã hội') ?></h4>

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
            'class' => 'btn btn-primary pull-right',
            'label' => [
                'text' => ''
            ],
            'type' => 'submit'
        ]) ?>

    <?= $this->Form->end() ?>
</div>