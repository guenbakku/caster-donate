<div class="white-box">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
                    'class' => 'img-circle img-responsive', 
                    'alt' => __('Ảnh đại diện'),
                ]) ?>
            </div>
        </div> 
        <div class="col-sm-9">
            <?php $this->Form->setTemplates($FormTemplates['vertical']);?>
            <?=$this->Form->create($profile, [
                'type' => 'file',
                'class' => 'form-horizontal',
            ]);?>
                <?= $this->cell('DragDropArea', [$this, 'avatar']) ?> 

            <div class="row">
                <div class="col-md-12">
                    <?= $this->Form->button( __('Lưu'),[
                        'class' => 'fcbtn btn btn-outline btn-success miw-150',
                        'label' => false,
                        'type' => 'submit'
                    ]) ?>
                    <?= $this->Html->link(
                        __('Xóa ảnh hiện tại'),
                        ['action' => 'delete'],
                        [
                            'class' => 'fcbtn btn btn-outline btn-danger m-l-10 miw-150',
                            'confirm' => __('Bạn có chắc chắn?'),
                        ]) 
                    ?>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
 
    </div>
</div>

