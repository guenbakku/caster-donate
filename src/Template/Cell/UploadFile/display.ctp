<?php 
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Collection\Collection;

$rootView->append('script');
?>

<script type="text/javascript">
    function uploadfile(form){
        var formdatas  = new FormData(form);
        $.ajax({
            url: $(form).attr('action'),
            dataType: 'json',
            method: 'post',
            data:  formdatas,
            contentType: false,
            processData: false
        }).done(function(response) {
            //console.log(response);
            if (response.result == true) {
                swalSuccess(response.message);
                <?php
                if($setting['callBackFunction'] != '')
                {?>
                    var callback = $.Callbacks();
                    callback.add(<?=$setting['callBackFunction']?>);
                    callback.fire(response);
                <?php
                }
                ?>
            }else if (response.result == false) {
                swalError(response.message);
            }
            //Xóa file trên DragDropArea
            var drEvent = $('#<?=$setting['drag_drop_area_id']?>').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
        })// .fail(function(jqXHR) { if (jqXHR.status == 403) { window.location = '/'; } else {  console.log(jqXHR); } })
        ;
        
        return false;
    }
</script>
<?php $rootView->end() ?>

<?php 
echo $this->Form->create($resource,[
    'url' => $this->Url->build('/api/v1/file/upload'),
    'id' => 'upload_image_form',
    'type' => 'file'
]);
echo $this->cell('DragDropArea', [$this, 'filename', $setting['drag_drop_area_id']]); 
echo $this->Form->hidden('resource_type_id', [
    'value' => $setting['file_type_id'],
    'label' => __('Giới tính'),
]) ;
echo $this->Form->submit('Thêm hình mới', array(
    'class' => 'form-control btn btn-block btn-success',
    'onClick' => 'return uploadfile(this.form)'
)); 
echo $this->Form->end();
?> 



