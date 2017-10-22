<?php
use Cake\Core\Configure;

$this->append('script');
    echo $this->Html->script('/packages/dropify/dist/js/dropify.min.js');
?>
<script type="text/javascript">
    $(function () {
        // Drop & drag upload file
        $('.dropify').dropify({
            messages: {
                default: '<?= __('Click chuột hoặc kéo thả file vào đây') ?>'
                , replace: '<?= __('Click chuột hoặc kéo thả file vào đây để thay đổi') ?>'
                , remove: '<?= __('Xóa') ?>'
                , error: '<?= __('Có lỗi xảy ra') ?>'
            },
            error: {
                'fileSize': '<?= __('Dung lượng file quá lớn (tối đa {{ value }}).') ?>',
            }
        });
    });
</script>
<?php $this->end() ?>

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
                <?= $this->Form->control('avatar', [
                    'class' => 'dropify',
                    'data-max-file-size' => Configure::read('vcv.uploadFileSize'),
                    'templateVars' => [
                        'type' => 'file'
                    ],
                    'type' => 'file',
                    'label' => false,
                ]) ?>

            <div class="row">
                <div class="col-md-12">
                    <?= $this->Form->button( __('Cập nhật'),[
                        'class' => 'btn btn-success',
                        'label' => false,
                        'type' => 'submit'
                    ]) ?>
                    <?= $this->Html->link(
                        __('Xóa ảnh hiện tại'),
                        [
                            'action' => 'delete',
                        ],
                        [
                            'class' => 'btn btn-danger m-l-10',
                            'confirm' => __('Bạn có chắc chắn?'),
                        ]) 
                    ?>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
 
    </div>
</div>

