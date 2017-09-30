<div class="tab-pane active" id="profile">
    <?php $this->Form->setTemplates([
        'inputContainer' => '<div class="form-group">{{content}}</div>',
        'input' => '<div class="col-sm-10"><input type="{{type}}" name="{{name}}" {{attrs}} /></div>',
        'file' => '<div class="col-sm-10"><input type="{{type}}" name="{{name}}" {{attrs}} /></div>',
        'dateWidget' => '<div class="col-sm-10">Ngày{{day}} Tháng{{month}} Năm{{year}}</div>',
        'textarea' => '<div class="col-sm-10"><textarea name="{{name}}"{{attrs}}>{{value}}</textarea></div>',
        'button' => '<div class="form-group"><div class="col-sm-12"><button name="{{name}}"{{attrs}}>{{text}}</button></div></div>',
        'label' => '<label class="col-sm-2 control-label" {{attrs}}>{{text}}</label>',
    ]);?>
    <?=$this->Form->create($profile, [
        'type' => 'file',
        'class' => 'form-horizontal',
    ]);?>
        <?= $this->Form->control('avatar', [
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
                'class' => 'form-control dateinput',
                'type'  => 'text',
                'label' => [
                    'text' =>  __('Ngày sinh')
                ],
            ]);
        ?>

        <?= $this->Form->control('location', [
                'class' => 'form-control',
                'type'  => 'text',
                'label' => [
                    'text' =>  __('Nơi ở')
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

        <?= $this->Form->button( __('Cập nhật'),[
                'class' => 'btn btn-danger pull-right',
                'label' => [
                    'text' => ''
                ],
                'type' => 'submit'
            ]);
        ?>

    <?= $this->Form->end() ?>
</div>