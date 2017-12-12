<?php
echo $this->Html->css('/packages/image-picker/css/image-picker.css', ['block' => 'css']);
echo $this->Html->css('/packages/x-editable/css/bootstrap-editable.css', ['block' => 'css']);

echo $this->Html->script('/packages/image-picker/js/image-picker.min.js', ['block' => 'script']);
echo $this->Html->script('/packages/x-editable/js/bootstrap-editable.min.js', ['block' => 'script']);
$this->append("script");
?>
<script>
 $(function () {
   //inline
    $('.editable[data-type="text"]').editable({
        type: 'text',
        pk: 1, 
        name: 'username', 
    });
    $('.editable[data-type="select"]').editable({
        source: [
              {value: 1, text: '[Người ủng hộ]'},
              {value: 2, text: '[Người nhận]'},
              {value: 3, text: '[Số tiền]'}
        ]
    });

    jQuery("select.image-picker").imagepicker({
        hide_select:  false,
        show_label: true
    });
    $('.image_picker_selector').addClass( "flex-container" );
    $('.image_picker_selector').find('li').addClass( "flex-item" );

});
</script>
<?php
$this->end();
$this->append("css");
?>

<style type="text/css">
.image_picker_selector{
    text-align: center;
}
.flex-container {
    display: flex;
    flex-direction: row;
    align-items: stretch;
    height: 100%;
}
.flex-container::-webkit-scrollbar{
	width: 12px;
	background-color: #3c4452;
}
.flex-container::-webkit-scrollbar-thumb{
    border-radius: 10px;
	background-color: #ff7676;
	border: 1px solid #555555;
}

.flex-item {
    min-width: 20%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
<?php
$this->end();
?>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Xem trước thông báo')?></div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Thiết lập thông báo')?></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
                        <?=$this->Form->create(null, [
                            'type' => 'put',
                            'class' => 'form-horizontal',
                        ]);?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=__('Thông điệp')?></label>
                            <div class="col-sm-9">
                                <a href="#" data-type="text" data-pk="1" class="editable" data-original-title="" title="">Cảm ơn bạn</a>
                                <a href="#" id="target1" data-type="select" data-value="1" class="editable"></a>
                                <a href="#" data-type="text" data-pk="1" class="editable" data-original-title="" title="">đã ủng hộ</a>
                                <a href="#" id="target1" data-type="select" data-value="2" class="editable"></a>
                                <a href="#" data-type="text" data-pk="1" class="editable" data-original-title="" title="">số tiền</a>
                                <a href="#" id="target1" data-type="select" data-value="3" class="editable"></a>
                                <a href="#" data-type="text" data-pk="1" class="editable" data-original-title="" title="">đồng.</a>
                            </div>
                        </div>
                        
                            <label class="col-sm-3 control-label"><?=__('Lựa chọn hình ảnh')?></label>
                            <div class="col-sm-9">
                                <select class="image-picker">
                                    <option data-img-src="https://cdn.cloudpix.co/images/liam-neeson/liam-neeson-wallpaper-d4456958a1ebe442be628ce48434fc89-large-1304324.jpg" value="1">Cute Kitten 1</option>
                                    <option data-img-src="https://images.unsplash.com/photo-1485811055483-1c09e64d4576?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="2">Cute Kitten 2</option>
                                    <option data-img-src="http://placekitten.com/400/150" value="3">Cute Kitten 2</option>
                                    <option data-img-src="http://placekitten.com/450/151" value="4">Cute Kitten 5</option>
                                    <option data-img-src="https://images.unsplash.com/photo-1468436139062-f60a71c5c892?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="5">Cute Kitten 5</option>
                                    <option data-img-src="https://images.unsplash.com/photo-1504889270807-ccd74713ad45?auto=format&fit=crop&w=634&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="6">Cute Kitten 5</option>
                                    <option data-img-src="https://images.unsplash.com/photo-1476493279419-b785d41e38d8?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="7">Cute Kitten 5</option>
                                    <option data-img-src="https://images.unsplash.com/photo-1510253782297-404c4da27214?auto=format&fit=crop&w=1351&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="8">Cute Kitten 5</option>
                                    <option data-img-src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="9">Cute Kitten 5</option>
                                </select>
                            </div>


                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>