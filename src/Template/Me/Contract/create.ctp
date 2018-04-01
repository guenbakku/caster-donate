<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <?=$this->Form->create(null, [
        'type' => 'put',
        'class' => 'form-horizontal',
    ]);?>
        <h4 class="m-t-0"><?= __('Thông tin cơ bản') ?></h4>
        <?= $this->Form->control('nickname', [
            'class' => 'form-control',
            'label' => __('Nickname'),
        ]) ?>

        <?= $this->Form->control('firstname', [
            'class' => 'form-control',
            'label' => __('Họ và tên đệm'),
        ]) ?>

        <?= $this->Form->control('lastname', [
            'class' => 'form-control',
            'label' => __('Tên'),
        ]) ?>

        <?= $this->Form->control('sex_id', [
            'class' => 'form-control',
            'empty' => true,
            'options' => $this->Code->setTable('sexes')->getList(),
            'label' => __('Giới tính'),
        ]) ?>

        <?= $this->Form->control('birthday', [
            'class' => 'form-control',
            'type'  => 'text',
            'data-mask' => "99/99/9999",
            'placeholder' => 'dd/mm/yyyy',
            'label' => __('Ngày sinh'),
        ]) ?>

        <?= $this->Form->control('location', [
            'class' => 'form-control',
            'type'  => 'text',
            'label' => __('Nơi ở'),
        ]) ?>

        <?= $this->Form->control('introduction', [
            'class' => 'form-control',
            'type'  => 'textarea',
            'rows'  => 3,
            'label' => __('Lời giới thiệu'),
        ]) ?>

        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Html->link( __('Quay lại'), [
                    'action' => 'term',
                ], [
                    'class' => 'btn btn-default miw-100',
                ]) ?>
                <?= $this->Form->button( __('Gửi'), [
                    'class' => 'btn btn-success miw-100',
                    'label' => false,
                    'type' => 'submit'
                ]) ?>
            </div>
        </div>

    <?= $this->Form->end() ?>
</div>
