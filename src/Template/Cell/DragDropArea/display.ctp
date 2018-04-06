<?php use Cake\Core\Configure; ?>

<?php if ($firstCall === true): ?>
    <?php $rootView->append('script') ?>
    <?php echo $rootView->Html->script('/packages/dropify/dist/js/dropify.min.js'); ?>
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
    <?php $rootView->end(); ?>
<?php endif ?>

<?= $rootView->Form->control($fieldname, array_merge([
    'class' => 'dropify',
    'data-max-file-size' => Configure::read('vcv.uploadFileSize'),
    'templateVars' => [
        'type' => 'file',
    ],
    'type' => 'file',
    'label' => false,
], $options)) ?>