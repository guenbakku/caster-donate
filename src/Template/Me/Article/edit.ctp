<div class="col-md-12">
    <div class="white-box">
        <h3 class="box-title"><?=__('Chỉnh sửa nội dung bài viết')?></h3>
        <hr class="m-t-0 m-b-40">
        <section class="m-t-40">
            <?=$this->Form->create($article, [
                'type' => 'put',
                'class' => 'form-horizontal',
            ]);?>
                <?= $this->Form->control('id', [
                    'class' => 'form-control',
                    'type' => 'hidden',
                ]) ?>
                <?= $this->Form->control('title', [
                    'class' => 'form-control',
                    'label' => __('Tiêu đề'),
                ]) ?>
                <div class="clearfix"></div>
                <?= $this->Form->control('content', [
                    'class' => 'textarea_editor form-control',
                    'rows'  => 15,
                    'placeholder' => __('Nhập nội dung vào đây').'....',
                    'type'  => 'textarea',
                    'label' => __('Nội dung'),
                ]) ?>
                <div class="text-right">
                    <?=$this->Html->link(
                        __('Quay lại'),
                        [
                            'prefix' => 'me',
                            'controller' => 'article',
                            'action' => 'index',
                        ],
                        [
                            'class' => 'fcbtn btn btn-outline btn-default miw-100', 
                            'role' => 'button'
                        ]
                    );?>
                    <?= $this->Form->button( __('Sửa'),[
                        'class' => 'fcbtn btn btn-outline btn-success miw-100',
                        'label' => false,
                        'type' => 'submit'
                    ]) ?>
                </div>
            <?= $this->Form->end() ?>
        </section>
    </div>
</div>