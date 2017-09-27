<?php $this->Form->setTemplates([
    'inputContainer' => '<div class="form-group">{{content}}</div>',
    'input' => '<div class="col-sm-10"><input type="{{type}}" name="{{name}}" {{attrs}} /></div>',
    'dateWidget' => '<div class="col-sm-10">Ngày{{day}} Tháng{{month}} Năm{{year}}</div>',
    'textarea' => '<div class="col-sm-10"><textarea name="{{name}}"{{attrs}}>{{value}}</textarea></div>',
    'button' => '<div class="form-group"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
    'label' => '<label class="col-sm-2 control-label" {{attrs}}>{{text}}</label>',
]);?>
<?=$this->Form->create($profile, [
    'url' => [
        'controller' => 'Me',
        'action' => 'editProfile',
    ],
    'type' => 'file',
    'class' => 'form-horizontal',
]);?>
    <?= $this->Form->control('avatar', [
            'templates' => [
                'inputContainer' => '<div class="form-group">{{content}}</div>',
                'file' => '<div class="col-sm-10"><input type="{{type}}" name="{{name}}" {{attrs}} /></div>'
            ],
            'class' => 'form-control',
            'templateVars' => [
                'type' => 'file'
            ],
            'type' => 'file',
            'label' => [
                'text' =>  __('Ảnh đại diện')
            ],
        ]);
    ?>

    <?= $this->Form->control('nickname', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Biệt danh')
            ],
        ]);
    ?>

    <?= $this->Form->control('firstname', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Họ và tên đệm')
            ],
        ]);
    ?>

    <?= $this->Form->control('lastname', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Tên')
            ],
        ]);
    ?>

    <?= $this->Form->control('birthday', [
            'class' => 'form-control',
            'type'  => 'date',
            'label' => [
                'text' =>  __('Ngày sinh')
            ],
            'empty' => true,
            'minYear' => 1950,
            'maxYear' => date('Y'),
            'monthNames' =>[
                '01' => 'Một',
                '02' => 'Hai',
                '03' => 'Ba',
                '04' => 'Bốn',
                '05' => 'Năm',
                '06' => 'Sáu',
                '07' => 'Bảy',
                '08' => 'Tám',
                '09' => 'Chín',
                '10' => 'Mười',
                '11' => 'Mười một',
                '12' => 'Mười hai', 
            ],
        ]);
    ?>

    <?= $this->Form->control('facebook', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Facebook')
            ],
        ]);
    ?>

    <?= $this->Form->control('facebook_public', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Công khai Facebook')
            ],
        ]);
    ?>

    <?= $this->Form->control('zalo', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Zalo')
            ],
        ]);
    ?>
    
    <?= $this->Form->control('zalo_public', [
            'class' => 'form-control',
            'label' => [
                'text' =>  __('Công khai Zalo')
            ],
        ]);
    ?>

    <?= $this->Form->control('introduction', [
            'class' => 'form-control',
            'type'  => 'textarea',
            'label' => [
                'text' =>  __('Lời giới thiệu')
            ],
        ]);
    ?>
    
    <?= $this->Form->button( __('Cập nhật thông tin'),[
            'class' => 'btn btn-danger pull-right',
            'label' => [
                'text' => ''
            ],
            'type' => 'submit'
        ]);
    ?>
    
<?= $this->Form->end() ?>