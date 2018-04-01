<?php
echo $this->Html->css('/packages/x-editable/css/bootstrap-editable.css', ['block' => 'css']);
echo $this->Html->css('/packages/Touchspin/css/jquery.bootstrap-touchspin.min.css', ['block' => 'css']);
echo $this->Html->css('/packages/jquery-asColorPicker-master/css/asColorPicker.css', ['block' => 'css']);

echo $this->Html->script('/packages/x-editable/js/bootstrap-editable.min.js', ['block' => 'script']);
echo $this->Html->script('/packages/Touchspin/js/jquery.bootstrap-touchspin.min.js', ['block' => 'script']);
echo $this->Html->script('/packages/jquery-asColorPicker-master/js/jquery-asColor.js', ['block' => 'script']);
echo $this->Html->script('/packages/jquery-asColorPicker-master/js/jquery-asGradient.js', ['block' => 'script']);
echo $this->Html->script('/packages/jquery-asColorPicker-master/js/jquery-asColorPicker.min.js', ['block' => 'script']); 
?>

<?php $this->append("script"); ?>

<script>
    var audio = new Audio();
    var anime_handle;

    var image_input = $('input[name=image_id]');
    var audio_input = $('select[name=audio_id]');
    var textColor1 = $('input[name=text_color_1]');
    var textColor2 = $('input[name=text_color_2]');
    var appearEffect = $('select[name=appear_effect]');
    var disappearEffect = $('select[name=disappear_effect]');
    var time_input = $("input[name='display_time']");
    var notify_message_array = JSON.parse('<?=$donation_notification_setting->notify_message_array?>');
    
    var notify_box = $('#alert-donate-box');
    var notify_box_image = $('#alert-donate-image');

    /********************
    ******INITILIAZIE****
    *********************/
    $(document).ready(function () {
        $('#<?=$donation_notification_setting->image_id?>').prop('checked', true);        

        $('#message1').html(notify_message_array.message1);
        $('#message2').html(notify_message_array.message2);
        $('#message3').html(notify_message_array.message3);
        $('#message4').html(notify_message_array.message4);
        $('#target1').html(notify_message_array.target1);
        $('#target2').html(notify_message_array.target2);
        $('#target3').html(notify_message_array.target3);

        $('.editable[data-type="text"]').editable({
            type: 'text',
            emptytext: '___',
            pk: 1, 
            name: 'username', 
        });
        $('.editable[data-type="select"]').editable({
            prepend: "「___」",
            source: [
                {value: 1, text: '「<?=__('Người ủng hộ')?>」'},
                {value: 2, text: '「<?=__('Số tiền')?>」'},
            ]
        });
    
        time_input.TouchSpin({
            min: 4,
            max: 20,
        });

        $(".colorpicker").asColorPicker();
        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });
    });

    
    /********************
    ******LISTENERS******
    *********************/
    $('.js--triggerAnimation').click(function (e) {
        e.preventDefault();
        var anim = $('#'+$(this).data('value')).val();
        var target = $(this).data('target');
        previewAnimation(anim,'#' + target);
    });
    $('.js--animations').change(function () {
        var anim = $(this).val();
        var target = $(this).data('target');
        previewAnimation(anim,'#' + target);
    });
    $('#alert-donate-preview-button').click(function(e){
        clearTimeout(anime_handle);
        //cập nhật nội dung text
        var m1 = $('#message1').html();
        var m2 = $('#message2').html();
        var m3 = $('#message3').html();
        var m4 = $('#message4').html();
        var t1 = $('#target1').html();
        var t2 = $('#target2').html();
        var t3 = $('#target3').html();
        $('.alert-donate-thank-you')
            .css('color',textColor1.val())
            .html(replaceMessage(m1 + ' ' + t1 + ' ' + m2 + ' ' + t2 + ' ' + m3 + ' ' + t3 + ' ' + m4));
        $('.alert-donate-message')
            .css('color',textColor2.val())
            .html('Chúc bạn có buổi LiveStream vui vẻ.');
        //cập nhật hình ảnh
        var checked_input_id = $('input[name=image_id]:checked').attr("id");
        notify_box_image.attr('src',$("label[for='"+checked_input_id+"'] img").attr('src'));        
        //cập nhật âm thanh
        audio.pause();
        audio.currentTime = 0;
        audio.src = audio_input.find(":selected").data('url');
        audio.play();        
        //biểu diễn hiệu ứng
        previewAnimation(appearEffect.val(), '#'+notify_box.attr('id'));
        anime_handle = setTimeout(
            function() 
            {
                notify_box.delay( 800 ).removeClass().addClass(disappearEffect.val() + ' animated').one(
                    'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', 
                    function () {
                        audio.pause();
                        audio.currentTime = 0;
                    }
                );
            }, time_input.val() * 1000
        );
    });
    $('#save-setting-button').click(function(e){
        $('form#form-donate-setting').submit();
    });

    /********************
    ******FUNCTION*******
    *********************/
    function updateImageResourceAfterUpload(response){
        console.log(response.data);
        $('div.images').has('input[data-img-original=true]').remove();
        var img = $('<img>',{
            height  :   128,
            src     :   response.data.url
        });

        var label = $('<label>',{
            for :   response.data.id
        }).append(img);

        var input = $('<input>',{
            type    :    'radio',
            id      :    response.data.id,
            name    :    'image_id',
            value   :    response.data.id,
            checked  :   true,
            'data-img-original': true,
        });
        var div =   $('<div>',{
            class : 'images radio radio-info col-sm-6',
        }).append(input).append(label);
        $('#image_resources').prepend(div);
    }
    
    function updateAudioResourceAfterUpload(response){
        $('div').find('[data-audio-original=true]').remove();
        var dom = $('<option>',{
                'data-audio-original': true,
                'data-url': response.data.url,
                value: response.data.id,
            }).text(response.data.name);//hàm text đã thực hiện escape xxs
        $('#audio_resources').prepend(dom);
        $('option[data-audio-original=true]').prop('selected', true);
        console.log(response);
    }

    function previewAnimation(effect,target) {
        $(target).finish();
        $(target).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });
    };

    function replaceMessage(text){
        var f = ['「Người ủng hộ」','「Số tiền」','「___」','___'];
        var r = ['<strong>Nguyễn Văn A</strong>','<strong>10.000</strong>','',''];
        $.each(f,function(i,v) {
            var myregexp = new RegExp(v,'g');
            text = text.replace(myregexp,r[i]);
        });
        return text;
    }

</script>
<?php $this->end(); ?> 

<?php $this->append("css"); ?>
<style type="text/css">
.editable-cancel{
    display:none;
}
</style>
<?php $this->end(); ?>


<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Xem trước thông báo')?></div>
            <div class="panel-wrapper collapse in">

                 <?= $this->cell('AlertInterface::alertDonate', [$this]) ?> 
                
            </div>
            <div class="panel-footer clearfix">
                
                <div class="col-sm-6">
                    <button id="alert-donate-preview-button" class="btn btn-block btn-info"><?=__('Xem trước')?></button>
                </div>
                <div class="col-sm-6">
                    <button id="save-setting-button" class="btn btn-block btn-success"><?=__('Lưu thiết lập')?></button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-8 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Thiết lập thông báo')?></div>
            <?php $this->Form->setTemplates($FormTemplates['vertical']);?>
            <?=$this->Form->create($donation_notification_setting, [
                'type' => 'put',
                'class' => 'form-horizontal',
                'id' => 'form-donate-setting'
            ]);?>
            <section>
                <div class="sttabs tabs-style-iconbox">
                    <nav>
                        <ul>
                            <li class=""><a href="#section-iconbox-2" class="sticon mdi mdi-image-area"><span><?=__('Chọn hình ảnh')?></span></a></li>
                            <li class=""><a href="#section-iconbox-3" class="sticon mdi mdi-audiobook"><span><?=__('Chọn âm báo')?></span></a></li>
                            <li class=""><a href="#section-iconbox-4" class="sticon mdi mdi-blur"><span><?=__('Chọn hiệu ứng chữ')?></span></a></li>
                            <li class=""><a href="#section-iconbox-1" class="sticon mdi mdi-message-text"><span><?=__('Thông điệp')?></span></a></li>
                            <li class=""><a href="#section-iconbox-5" class="sticon mdi mdi-clock"><span><?=__('Thời gian hiển thị')?></span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap">
                        <section id="section-iconbox-2">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label class="control-label"><?=__('Lựa chọn hình ảnh')?></label><br>                                    
                                    </div>
                                    <div class="col-sm-9" id="image_resources">
                                        <?php
                                        $this->Form->templates([
                                            'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                            'radioWrapper' => '<div class="images radio radio-info col-sm-6"{{attrs}}>{{label}}</div>',
                                        ]);
                                        foreach($image_resources as $resource)
                                        {   
                                            $image_options[] = [ 
                                                'data-img-original' => (($resource->user_id == null)?'false':'true'),
                                                'value' => $resource->id,
                                                'text' => $this->Html->image($resource->url, ['height' => 128])
                                            ];
                                        }
                                        echo $this->Form->radio('image_id', $image_options, ['escape' => false]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </section>




                        <section id="section-iconbox-3">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label class="control-label"><?=__('Lựa chọn âm báo')?></label><br>                                    
                                    </div>
                                    <div class="col-sm-9">
                                        <?php
                                        foreach($audio_resources as $resource)
                                        {
                                            $audio_options[] = [ 
                                                'id' => $resource->id, 
                                                'data-audio-original' => (($resource->user_id == null)?'false':'true'), 
                                                'value' => $resource->id, 
                                                'data-url' => $this->Url->build($resource->url,['fullBase' => true]), 
                                                'text' => $resource->name 
                                            ];
                                        }
                                        echo $this->Form->select('audio_id',$audio_options,[
                                            'class' =>  'form-control my-designed-scrollbar',
                                            'name' =>  'audio_id',
                                            'id' =>  'audio_resources',
                                            'size' =>  '9',
                                        ]);
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </section>




                        <section id="section-iconbox-4">
                            <div class="white-box form-horizontal">  
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Màu chữ thông báo')?></label>
                                    <div class="col-sm-9">
                                        <?=$this->Form->text('text_color_1',[
                                            'class' => 'colorpicker form-control',
                                        ]);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Màu chữ lời nhắn')?></label>
                                    <div class="col-sm-9">
                                        <?=$this->Form->text('text_color_2',[
                                            'class' => 'colorpicker form-control',
                                        ]);?>
                                    </div>
                                </div>                          
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Hiệu ứng xuất hiện')?></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-8">
                                            <?php
                                                $options = [ 
                                                    __('Gây sự chú ý')  =>  [
                                                        'bounce'=>'bounce', 'flash'=>'flash', 'pulse'=>'pulse', 'rubberBand'=>'rubberBand', 'shake'=>'shake', 'swing'=>'swing', 'tada'=>'tada', 'wobble'=>'wobble', 'jello'=>'jello', 'rollIn'=>'rollIn', 
                                                    ],
                                                    __('Nẩy') => [
                                                        'bounceIn'=>'bounceIn', 'bounceInDown'=>'bounceInDown', 'bounceInLeft'=>'bounceInLeft', 'bounceInRight'=>'bounceInRight', 'bounceInUp'=>'bounceInUp', 
                                                    ],
                                                    __('Rõ dần') => [
                                                        'fadeIn'=>'fadeIn', 'fadeInDown'=>'fadeInDown', 'fadeInDownBig'=>'fadeInDownBig', 'fadeInLeft'=>'fadeInLeft', 'fadeInLeftBig'=>'fadeInLeftBig', 'fadeInRight'=>'fadeInRight', 'fadeInRightBig'=>'fadeInRightBig', 'fadeInUp'=>'fadeInUp', 'fadeInUpBig'=>'fadeInUpBig', 
                                                    ],
                                                    __('Lật') => [
                                                        'flip'=>'flip', 'flipInX'=>'flipInX', 'flipInY'=>'flipInY', 
                                                    ],
                                                    __('Trượt nhanh')  =>  [
                                                        'lightSpeedIn'=>'lightSpeedIn', 
                                                    ],
                                                    __('Xoay')  =>  [
                                                        'rotateIn'=>'rotateIn', 'rotateInDownLeft'=>'rotateInDownLeft', 'rotateInDownRight'=>'rotateInDownRight', 'rotateInUpLeft'=>'rotateInUpLeft', 'rotateInUpRight'=>'rotateInUpRight', 
                                                    ],
                                                    __('Trượt')  =>  [
                                                        'slideInUp'=>'slideInUp', 'slideInDown'=>'slideInDown', 'zoomInLeft'=>'zoomInLeft', 'zoomInRight'=>'zoomInRight', 'zoomInUp'=>'zoomInUp', 
                                                    ],
                                                    __('Phóng to')  =>  [
                                                        'zoomIn'=>'zoomIn', 'zoomInDown'=>'zoomInDown', 'zoomInLeft'=>'zoomInLeft', 'zoomInRight'=>'zoomInRight', 'zoomInUp'=>'zoomInUp', 
                                                    ],
                                                ];
                                                echo $this->Form->select('appear_effect',$options,[
                                                    'class' =>  'form-control js--animations',
                                                    'id' =>  'appearEffect',
                                                    'size' =>  '15',
                                                    'data-target'  =>  'animationSandbox1'
                                                ]);?>
                                            </div>

                                            <div class="col-sm-4 text-center"> 
                                                <span id="animationSandbox1" style="display: block;" class="">
                                                    <?=$this->Html->image('coconut-juice.jpg', ['width' => 128])?>
                                                </span>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info js--triggerAnimation" type="button" data-value="appearEffect" data-target="animationSandbox1"><?=__('Thử lại')?></button>
                                                </span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Hiệu ứng biến mất')?></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <?php
                                                $options = [ 
                                                    __('Nẩy biến mất') => [
                                                        'bounceOut'=>'bounceOut', 'bounceOutDown'=>'bounceOutDown', 'bounceOutLeft'=>'bounceOutLeft', 'bounceOutRight'=>'bounceOutRight', 'bounceOutUp'=>'bounceOutUp', 
                                                    ],
                                                    __('Mờ dần') => [
                                                        'fadeOut'=>'fadeOut', 'fadeOutDown'=>'fadeOutDown', 'fadeOutDownBig'=>'fadeOutDownBig', 'fadeOutLeft'=>'fadeOutLeft', 'fadeOutLeftBig'=>'fadeOutLeftBig', 'fadeOutRight'=>'fadeOutRight', 'fadeOutRightBig'=>'fadeOutRightBig', 'fadeOutUp'=>'fadeOutUp', 'fadeOutUpBig'=>'fadeOutUpBig', 
                                                    ],
                                                    __('Lật') => [
                                                        'flipOutX'=>'flipOutX', 'flipOutY'=>'flipOutY',
                                                    ],
                                                    __('Trượt nhanh')  =>  [
                                                        'lightSpeedOut'=>'lightSpeedOut', 
                                                    ],
                                                    __('Xoay')  =>  [
                                                        'rotateOut'=>'rotateOut', 'rotateOutDownLeft'=>'rotateOutDownLeft', 'rotateOutDownRight'=>'rotateOutDownRight', 'rotateOutUpLeft'=>'rotateOutUpLeft', 'rotateOutUpRight'=>'rotateOutUpRight', 
                                                    ],
                                                    __('Trượt')  =>  [
                                                        'slideOutUp'=>'slideOutUp', 'slideOutDown'=>'slideOutDown', 'slideOutLeft'=>'slideOutLeft', 'slideOutRight'=>'slideOutRight', 'zoomInUp'=>'zoomInUp', 
                                                    ],
                                                    __('Phóng to')  =>  [
                                                        'zoomOut'=>'zoomOut', 'zoomOutDown'=>'zoomOutDown', 'zoomOutLeft'=>'zoomOutLeft', 'zoomOutRight'=>'zoomOutRight', 'zoomOutUp'=>'zoomOutUp', 
                                                    ],
                                                    __('Khác')  =>  [
                                                        'hinge'=>'hinge', 'rollOut'=>'rollOut', 
                                                    ],
                                                ];
                                                echo $this->Form->select('disappear_effect',$options,[
                                                    'class' => 'form-control js--animations',
                                                    'id' => 'disappearEffect',
                                                    'size' => '15',
                                                    'data-target' => 'animationSandbox2'
                                                ]);?>
                                            </div>
                                            <div class="col-sm-4 text-center"> 
                                                <span id="animationSandbox2" style="display: block;" class="">
                                                    <?=$this->Html->image('coconut-juice.jpg', ['width' => 128])?>
                                                </span> 
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info js--triggerAnimation" type="button" data-value="disappearEffect" data-target="animationSandbox2"><?=__('Thử lại')?></button>
                                                </span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>





                        <section id="section-iconbox-1">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Thông điệp')?></label>
                                    <?php echo $this->Form->unlockField('notify_message_array');?>
                                    <div class="col-sm-9">
                                        <a href="#" id="message1" data-type="text" data-pk="1" class="editable" data-original-title=""></a>
                                        <a href="#" id="target1" data-type="select" data-value="1" class="editable"></a>
                                        <a href="#" id="message2" data-type="text" data-pk="1" class="editable" data-original-title=""></a>
                                        <a href="#" id="target2" data-type="select" data-value="2" class="editable"></a>
                                        <a href="#" id="message3" data-type="text" data-pk="1" class="editable" data-original-title=""></a>
                                        <a href="#" id="target3" data-type="select" data-value="3" class="editable"></a>
                                        <a href="#" id="message4" data-type="text" data-pk="1" class="editable" data-original-title=""></a>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="section-iconbox-5">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label"><?=__('Đơn vị:')?> <?=__('giây')?></label>
                                    <div class="col-sm-3">
                                        <?=$this->Form->text('display_time',[
                                            'label' => false,
                                        ]);?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /content -->
                </div>
                <!-- /tabs -->
            </section>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<div class="row">
<div class="col-md-offset-4 col-md-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Sử dụng hình ảnh riêng của bạn')?></div>
            <div class="panel-wrapper collapse in">
                <?php 
                $this->Form->setTemplates($FormTemplates['vertical']);
                echo $this->cell('UploadResource',[
                    $this, 
                    [
                        'button_text' => __('Thêm file hình ảnh'),
                        'resource_type_id' => $this->Code->setTable('resource_types')->getKey('image', 'id'),
                        'resource_feature_id' => $this->Code->setTable('resource_features')->getKey('donation_notification', 'id'),
                        'drag_drop_area_id'  =>  'upload_donate_image',
                        'callBackFunction'  => 'updateImageResourceAfterUpload',
                    ]
                ]);
                ?> 

            </div>
            <div class="col-sm-6">
                <br>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Sử dụng âm thanh riêng của bạn')?></div>
            <div class="panel-wrapper collapse in">
                <?php 
                $this->Form->setTemplates($FormTemplates['vertical']);
                echo $this->cell('UploadResource',[
                    $this, 
                    [
                        'button_text' => __('Thêm file âm thanh'),
                        'resource_type_id' => $this->Code->setTable('resource_types')->getKey('audio', 'id'),
                        'resource_feature_id' => $this->Code->setTable('resource_features')->getKey('donation_notification', 'id'),
                        'drag_drop_area_id'  =>  'upload_donate_audio',
                        'callBackFunction'  => 'updateAudioResourceAfterUpload',
                    ]
                ]);
                ?> 
            </div>
            <div class="col-sm-6">
                <br>
            </div>
        </div>
    </div>
</div>