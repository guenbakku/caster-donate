<?php
echo $this->Html->css('/packages/html5-editor/bootstrap-wysihtml5.css', ['block' => 'css']);

echo $this->AssetCompress->script('Me.Article.index.js', ['block' => 'script']);
?>

<div class="col-md-6">
    <div class="white-box">
        <h3 class="box-title"><?=__('Đăng bài mới')?></h3>
        <hr class="m-t-0 m-b-40">
        <section class="m-t-40">
            <?=$this->Form->create($article, [
                'type' => 'put',
                'class' => 'form-horizontal',
            ]);?>
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
                    <?= $this->Form->button( __('Đăng bài'),[
                        'class' => 'fcbtn btn btn-outline btn-success miw-100',
                        'label' => false,
                        'type' => 'submit'
                    ]) ?>
                </div>
            <?= $this->Form->end() ?>
        </section>
    </div>
</div>
<div class="col-md-6">
    <div class="white-box">
        <h3 class="box-title"><?=__('Các bài đã đăng')?></h3>
        <hr class="m-t-0 m-b-40">
        <section class="m-t-40" style="overflow:auto">
                <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list footable-loaded footable" data-page-size="10">
                    <thead>
                        <tr>
                            <th class="footable-sortable"><?=__('Thứ tự')?><span class="footable-sort-indicator"></span></th>
                            <th class="footable-sortable"><?=__('Tiêu đề')?><span class="footable-sort-indicator"></span></th>
                            <th class="footable-sortable footable-sorted"><?=__('Chỉnh sửa lần cuối')?><span class="footable-sort-indicator"></span></th>
                            <th class="footable-sortable"><?=__('Xóa')?><span class="footable-sort-indicator"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="footable-even" style="display: table-row;">
                                <td><span class="footable-toggle"></span>1</td>
                                <td>
                                    <a href="contact-detail.html">Arijit Singh</a>
                                </td>
                                <td>10-09-2014</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="<?=__('Xóa')?>"><i class="ti-close text-danger" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>                            
                            <td colspan="7">
                                <div class="text-right">
                                    <ul class="pagination">
                                        <?php echo $this->Paginator->numbers();?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table> 
        </section>
    </div>
</div>