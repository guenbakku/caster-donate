<?php
echo $this->Html->css('/packages/image-picker/css/image-picker.css', ['block' => 'css']);
echo $this->Html->css('/packages/x-editable/css/bootstrap-editable.css', ['block' => 'css']);
echo $this->Html->css('/packages/Touchspin/css/jquery.bootstrap-touchspin.min.css', ['block' => 'css']);
echo $this->Html->css('/packages/jquery-asColorPicker-master/css/asColorPicker.css', ['block' => 'css']);

echo $this->Html->script('/packages/image-picker/js/image-picker.min.js', ['block' => 'script']);
echo $this->Html->script('/packages/x-editable/js/bootstrap-editable.min.js', ['block' => 'script']);
echo $this->Html->script('/packages/Touchspin/js/jquery.bootstrap-touchspin.min.js', ['block' => 'script']);
echo $this->Html->script('/packages/jquery-asColorPicker-master/js/jquery-asColor.js', ['block' => 'script']);
echo $this->Html->script('/packages/jquery-asColorPicker-master/js/jquery-asGradient.js', ['block' => 'script']);
echo $this->Html->script('/packages/jquery-asColorPicker-master/js/jquery-asColorPicker.min.js', ['block' => 'script']); 
$this->append("script");
?>
<script>
 $(function () {
    //
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

    //
    $("select.image-picker").imagepicker();
    
    //
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
});
</script>
<script>
    
    function test(form){
        var formdatas  = new FormData(form);
        alert($(form).attr('action'));
        alert($(form).find('input[name="_csrfToken"]').val());
        $.ajax({
            url: $(form).attr('action'),
            dataType: 'json',
            method: 'post',
            data:  formdatas,
            contentType: false,
            processData: false
        }).done(function(response) {
                console.log(response);
                if (response.status == 'OK') {
                    
                }else if (response.status == 'FAIL') {

                }else {
                }
            })
            // .fail(function(jqXHR) {
            //     if (jqXHR.status == 403) {
            //         window.location = '/';
            //     } else {
            //         console.log(jqXHR);

            //     }
            // })
        ;
        
        return false;
    }
    function testAnim(effect,target) {
        $(target).finish();
        $(target).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });
    };
    $(document).ready(function () {
        var audio = new Audio();
        $('.js--triggerAnimation').click(function (e) {
            e.preventDefault();
            var anim = $('#'+$(this).data('value')).val();
            var target = $(this).data('target');
            testAnim(anim,'#' + target);
        });

        $('.js--animations').change(function () {
            var anim = $(this).val();
            var target = $(this).data('target');
            testAnim(anim,'#' + target);
        });
        $('#alert-donate-preview-button').click(function(e){
            // var group = $('#original-images');
            // $('<option />').data("img-src","http://placekitten.com/400/150").val(99).appendTo(group);
            // $("select.image-picker").imagepicker();
            //cập nhật nội dung text
            var m1 = replace_message($('#message1').html());
            var m2 = replace_message($('#message2').html());
            var m3 = replace_message($('#message3').html());
            var m4 = replace_message($('#message4').html());
            var t1 = replace_message($('#target1').html());
            var t2 = replace_message($('#target2').html());
            var t3 = replace_message($('#target3').html());
            $('.alert-donate-thank-you')
                .css('color',$('input[name=A]').val())
                .html(m1 + ' ' + t1 + ' ' + m2 + ' ' + t2 + ' ' + m3 + ' ' + t3 + ' ' + m4);
            $('.alert-donate-message')
                .css('color',$('input[name=B]').val())
                .html('Chúc bạn có buổi LiveStream vui vẻ.');
            //cập nhật hình ảnh
            $('#alert-donate-image').attr('src',$('select.image-picker option:selected').data('img-src'));
            //cập nhật âm thanh
            audio.pause();
            audio.currentTime = 0;
            audio.src = $("select[name='alert-donate-sound']").find(":selected").val();
            //audio.play();
            //biểu diễn hiệu ứng
            testAnim($('#animationValue1').val(), '#alert-donate-box');
            setTimeout(
            function() 
            {
                $('#alert-donate-box').delay( 800 ).removeClass().addClass($('#animationValue2').val() + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    audio.pause();
                    audio.currentTime = 0;
                });
            }, $("input[name='alert-donate-time']").val() * 1000);
        });
    });
    function replace_message(text){
        switch (text){
            case '[Người ủng hộ]': text = '<strong>Nguyễn Văn A</strong>'; break;
            case '[Người nhận]': text = '<strong><?=$this->Auth->user('profile.nickname')?></strong>'; break;
            case '[Số tiền]': text = '<strong>10.000</strong>'; break;
            case 'Empty': text = ''; break;
            default: break;
        }
        return text;
    }
    //
    $("input[name='alert-donate-time']").TouchSpin({
        initval: 40
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
.thumbnails.image_picker_selector li .thumbnail img {
    height: 70px;
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

                 <?= $this->cell('AlertInterface::alertDonate', [$this]) ?> 
                
            </div>
            <div class="panel-footer clearfix">
                <div class="col-sm-6">
                    <button id="alert-donate-preview-button" class="btn btn-block btn-info"><?=__('Xem trước')?></button>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-block btn-success"><?=__('Lưu thiết lập')?></button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-8 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=__('Thiết lập thông báo')?></div>
            <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
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
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <select class="form-control image-picker">
                                                <optgroup id="original-images" label="<?=__('Hình ảnh riêng của bạn')?>">
                                                    <option data-img-src="https://images.unsplash.com/photo-1485811055483-1c09e64d4576?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="2"></option>
                                                </optgroup>
                                                <optgroup label="<?=__('Hình ảnh có sẵn')?>">
                                                    <option data-img-src="http://placekitten.com/400/150" value="3"></option>
                                                    <option data-img-src="http://placekitten.com/450/151" value="4"></option>
                                                    <option data-img-src="https://images.unsplash.com/photo-1468436139062-f60a71c5c892?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="5"></option>
                                                    <option data-img-src="https://images.unsplash.com/photo-1504889270807-ccd74713ad45?auto=format&fit=crop&w=634&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="6"></option>
                                                    <option data-img-src="https://images.unsplash.com/photo-1476493279419-b785d41e38d8?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="7"></option>
                                                    <option data-img-src="https://images.unsplash.com/photo-1510253782297-404c4da27214?auto=format&fit=crop&w=1351&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="8"></option>
                                                    <option data-img-src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="9"></option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('hoặc sử dụng hình ảnh của bạn')?></label>
                                    <div class="col-sm-9">

                                        <?php $this->Form->setTemplates($FormTemplates['vertical']);
                                        echo $this->Form->create($donation_notification_setting,[
                                            'url' => $this->Url->build('/api/v1/file/upload'),
                                            'id' => 'upload_image_form'
                                        ]);
                                        echo $this->cell('DragDropArea', [$this, 'image']); 
                                        echo $this->Form->submit('Thêm hình mới', array(
                                            'class' => 'form-control btn btn-block btn-success',
                                            'onClick' => 'return test(this.form)'
                                        )); 
                                        echo $this->Form->end();
                                        ?> 
                                    </div>
                                </div>
                            </div>
                        </section>




                        <section id="section-iconbox-3">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Sử dụng tài nguyên sẵn có')?></label>
                                    <div class="col-sm-9">
                                        <select class="form-control my-designed-scrollbar" name="alert-donate-sound" size="9">
                                        <option value="https://freemusicarchive.org/file/music/Creative_Commons/Podington_Bear/Piano_IV_Cinematic/Podington_Bear_-_Bittersweet.mp3" selected>Jam On It</option>
                                        <option value="https://freemusicarchive.org/file/music/WFMU/Broke_For_Free/Directionless_EP/Broke_For_Free_-_01_-_Night_Owl.mp3">Stoker</option>
                                        <option value="https://freemusicarchive.org/file/music/no_curator/Tours/Enthusiast/Tours_-_01_-_Enthusiast.mp3">Skull Fire</option>
                                        <option value="https://freemusicarchive.org/file/music/none_given/Audiobinger/Audiobinger_-_Singles/Audiobinger_-_Sandman.mp3">Scurvy Pirate</option>
                                        <option value="https://freemusicarchive.org/file/music/ccCommunity/Borrtex/Snowflake/Borrtex_-_01_-_Snowflake.mp3">Circle</option>
                                        <option value="https://freemusicarchive.org/file/music/ccCommunity/Dan_Lerch/A_Very_Badgerland_Christmas_2011/Dan_Lerch_-_09_-_O_Tannenbaum.mp3">Palse</option>
                                        <option value="https://freemusicarchive.org/file/music/ccCommunity/Lobo_Loco/CAVE_OF_MIRACLES/Lobo_Loco_-_05_-_Manhattan_Skyline_ID_761.mp3">Hello</option>
                                        <option value="https://freemusicarchive.org/file/music/no_curator/Scott_Holmes/Corporate__Motivational_Music/Scott_Holmes_-_09_-_Follow_your_Dreams.mp3">Samurai Heart</option>
                                        <option value="https://freemusicarchive.org/file/music/none_given/Audiobinger/Audiobinger_-_Singles/Audiobinger_-_Sandman.mp3">Tone 1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('hoặc sử dụng file âm thanh của bạn')?></label>
                                    <div class="col-sm-9">
                            
                                        <?php $this->Form->setTemplates($FormTemplates['vertical']);?>
                                        <?= $this->cell('DragDropArea', [$this, 'audio']) ?> 

                                    </div>
                                </div>
                            </div>
                        </section>




                        <section id="section-iconbox-4">
                            <div class="white-box form-horizontal">                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Hiệu ứng xuất hiện')?></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div>
                                                    <select id="animationValue1" class="form-control js--animations" data-target="animationSandbox1" size="15">
                                                        <optgroup label="Attention Seekers">
                                                            <option value="bounce" selected>bounce</option>
                                                            <option value="flash">flash</option>
                                                            <option value="pulse">pulse</option>
                                                            <option value="rubberBand">rubberBand</option>
                                                            <option value="shake">shake</option>
                                                            <option value="swing">swing</option>
                                                            <option value="tada">tada</option>
                                                            <option value="wobble">wobble</option>
                                                            <option value="jello">jello</option>
                                                        </optgroup>
                                                        <optgroup label="Bouncing Entrances">
                                                            <option value="bounceIn">bounceIn</option>
                                                            <option value="bounceInDown">bounceInDown</option>
                                                            <option value="bounceInLeft">bounceInLeft</option>
                                                            <option value="bounceInRight">bounceInRight</option>
                                                            <option value="bounceInUp">bounceInUp</option>
                                                        </optgroup>
                                                        <optgroup label="Fading Entrances">
                                                            <option value="fadeIn">fadeIn</option>
                                                            <option value="fadeInDown">fadeInDown</option>
                                                            <option value="fadeInDownBig">fadeInDownBig</option>
                                                            <option value="fadeInLeft">fadeInLeft</option>
                                                            <option value="fadeInLeftBig">fadeInLeftBig</option>
                                                            <option value="fadeInRight">fadeInRight</option>
                                                            <option value="fadeInRightBig">fadeInRightBig</option>
                                                            <option value="fadeInUp">fadeInUp</option>
                                                            <option value="fadeInUpBig">fadeInUpBig</option>
                                                        </optgroup>
                                                        <optgroup label="Flippers">
                                                            <option value="flip">flip</option>
                                                            <option value="flipInX">flipInX</option>
                                                            <option value="flipInY">flipInY</option>
                                                        </optgroup>
                                                        <optgroup label="Lightspeed">
                                                            <option value="lightSpeedIn">lightSpeedIn</option>
                                                        </optgroup>
                                                        <optgroup label="Rotating Entrances">
                                                            <option value="rotateIn">rotateIn</option>
                                                            <option value="rotateInDownLeft">rotateInDownLeft </option>
                                                            <option value="rotateInDownRight">rotateInDownRight </option>
                                                            <option value="rotateInUpLeft">rotateInUpLeft</option>
                                                            <option value="rotateInUpRight">rotateInUpRight </option>
                                                        </optgroup>
                                                        <optgroup label="Sliding Entrances">
                                                            <option value="slideInUp">slideInUp</option>
                                                            <option value="slideInDown">slideInDown</option>
                                                            <option value="slideInLeft">slideInLeft</option>
                                                            <option value="slideInRight">slideInRight</option>
                                                        </optgroup>
                                                        <optgroup label="Zoom Entrances">
                                                            <option value="zoomIn">zoomIn</option>
                                                            <option value="zoomInDown">zoomInDown</option>
                                                            <option value="zoomInLeft">zoomInLeft</option>
                                                            <option value="zoomInRight">zoomInRight</option>
                                                            <option value="zoomInUp">zoomInUp</option>
                                                        </optgroup>
                                                        <optgroup label="Specials">
                                                            <option value="rollIn">rollIn</option>
                                                        </optgroup>
                                                    </select> 
                                                </div>
                                            </div>

                                            <div class="col-sm-4 text-center"> 
                                                <span id="animationSandbox1" style="display: block;" class="">
                                                    <img width="100" height="100" src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D">
                                                </span> 

                                                <span class="input-group-btn">
                                                    <button class="btn btn-info js--triggerAnimation" type="button" data-value="animationValue1" data-target="animationSandbox1"><?=__('Thử lại')?></button>
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
                                                <div>
                                                    <select id="animationValue2" class="form-control js--animations" data-target="animationSandbox2" size="15">
                                                        <optgroup label="Bouncing Exits">
                                                            <option value="bounceOut" selected>bounceOut</option>
                                                            <option value="bounceOutDown">bounceOutDown</option>
                                                            <option value="bounceOutLeft">bounceOutLeft</option>
                                                            <option value="bounceOutRight">bounceOutRight</option>
                                                            <option value="bounceOutUp">bounceOutUp</option>
                                                        </optgroup>
                                                        <optgroup label="Fading Exits">
                                                            <option value="fadeOut">fadeOut</option>
                                                            <option value="fadeOutDown">fadeOutDown</option>
                                                            <option value="fadeOutDownBig">fadeOutDownBig</option>
                                                            <option value="fadeOutLeft">fadeOutLeft</option>
                                                            <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                                                            <option value="fadeOutRight">fadeOutRight</option>
                                                            <option value="fadeOutRightBig">fadeOutRightBig </option>
                                                            <option value="fadeOutUp">fadeOutUp</option>
                                                            <option value="fadeOutUpBig">fadeOutUpBig</option>
                                                        </optgroup>
                                                        <optgroup label="Flippers">
                                                            <option value="flipOutX">flipOutX</option>
                                                            <option value="flipOutY">flipOutY</option>
                                                        </optgroup>
                                                        <optgroup label="Lightspeed">
                                                            <option value="lightSpeedOut">lightSpeedOut</option>
                                                        </optgroup>
                                                        <optgroup label="Rotating Exits">
                                                            <option value="rotateOut">rotateOut</option>
                                                            <option value="rotateOutDownLeft">rotateOutDownLeft </option>
                                                            <option value="rotateOutDownRight"> rotateOutDownRight </option>
                                                            <option value="rotateOutUpLeft">rotateOutUpLeft </option>
                                                            <option value="rotateOutUpRight">rotateOutUpRight </option>
                                                        </optgroup>
                                                        <optgroup label="Sliding Exits">
                                                            <option value="slideOutUp">slideOutUp</option>
                                                            <option value="slideOutDown">slideOutDown</option>
                                                            <option value="slideOutLeft">slideOutLeft</option>
                                                            <option value="slideOutRight">slideOutRight</option>
                                                        </optgroup>
                                                        <optgroup label="Zoom Exits">
                                                            <option value="zoomOut">zoomOut</option>
                                                            <option value="zoomOutDown">zoomOutDown</option>
                                                            <option value="zoomOutLeft">zoomOutLeft</option>
                                                            <option value="zoomOutRight">zoomOutRight</option>
                                                            <option value="zoomOutUp">zoomOutUp</option>
                                                        </optgroup>
                                                        <optgroup label="Specials">
                                                            <option value="hinge">hinge</option>
                                                            <option value="rollOut">rollOut</option>
                                                        </optgroup>
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-center"> 
                                                <span id="animationSandbox2" style="display: block;" class="">
                                                    <img width="100" height="100" src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D">
                                                </span> 
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info js--triggerAnimation" type="button" data-value="animationValue2" data-target="animationSandbox2"><?=__('Thử lại')?></button>
                                                </span> 
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Màu chữ thông báo')?></label>
                                    <div class="col-sm-9">
                                        <input name="A" type="text" class="colorpicker form-control" value="#ff7676" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Màu chữ lời nhắn')?></label>
                                    <div class="col-sm-9">
                                        <input name="B" type="text" class="colorpicker form-control" value="#ffffff" />
                                    </div>
                                </div>
                            </div>
                        </section>





                        <section id="section-iconbox-1">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?=__('Thông điệp')?></label>
                                    <div class="col-sm-9">
                                        <a href="#" id="message1" data-type="text" data-pk="1" class="editable" data-original-title="" title="">Cảm ơn bạn</a>
                                        <a href="#" id="target1" data-type="select" data-value="1" class="editable"></a>
                                        <a href="#" id="message2" data-type="text" data-pk="1" class="editable" data-original-title="" title="">đã ủng hộ</a>
                                        <a href="#" id="target2" data-type="select" data-value="2" class="editable"></a>
                                        <a href="#" id="message3" data-type="text" data-pk="1" class="editable" data-original-title="" title="">số tiền</a>
                                        <a href="#" id="target3" data-type="select" data-value="3" class="editable"></a>
                                        <a href="#" id="message4" data-type="text" data-pk="1" class="editable" data-original-title="" title="">đồng.</a>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="section-iconbox-5">
                            <div class="white-box form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label"><?=__('Đơn vị:')?> <?=__('giây')?></label>
                                    <div class="col-sm-3">
                                        <input type="text" value="5" name="alert-donate-time" data-bts-button-down-class="btn btn-default btn-outline" data-bts-button-up-class="btn btn-default btn-outline">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /content -->
                </div>
                <!-- /tabs -->
            </section>


        </div>
    </div>
</div>