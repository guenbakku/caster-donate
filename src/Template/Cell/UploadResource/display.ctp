<?php 
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Collection\Collection;

$rootView->append('script');
$cell_id = rand();
?>

<script type="text/javascript">
    function uploadFile<?=$cell_id?>(form){
        var formdatas  = new FormData(form);
        var callBackFunction = <?=$settings['callBackFunction']?>;
        $.ajax({
            url: $(form).attr('action'),
            dataType: 'json',
            method: 'post',
            data:  formdatas,
            contentType: false,
            processData: false
        }).done(function (response) {
            if (response.errors.length == 0) {
                swalSuccess('' + response.title, '' + response.message);
                if(callBackFunction != ''){
                    var callback = $.Callbacks();
                    callback.add(callBackFunction);
                    callback.fire(response);
                }
            } else {
                swalError('' + response.title, '' + response.errors.join('<br>'));
            }
            //Xóa file trên DragDropArea
            var drEvent = $('#<?=$settings['drag_drop_area_id']?>').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
        }).fail(function (jqXHR) { 
            swalError('' + jqXHR.status,'' +jqXHR.text);
        });
        
        return false;
    }
</script>
<?php $rootView->end() ?>

<?php
$formUrl = Hash::get($settings, 'url', [
    'prefix' => 'api/v1',
    'controller' => 'Resources',
    'action' => 'upload',
]);

echo $rootView->Form->create($resource,[
    'url' => $formUrl,
    'id' => 'upload_image_form',
    'type' => 'file'
]);
echo $rootView->cell('DragDropArea', [$rootView, 'filename', $settings['drag_drop_area_id']]); 
echo $rootView->Form->hidden('resource_type_id', [
    'value' => $settings['resource_type_id'],
]) ;
echo $rootView->Form->hidden('resource_feature_id', [
    'value' => $settings['resource_feature_id'],
]) ;
echo $rootView->Form->submit($settings['button_text'], array(
    'class' => 'form-control btn btn-block btn-success',
    'onClick' => 'return uploadFile'.$cell_id.'(this.form)'
)); 
echo $rootView->Form->end();
?> 



