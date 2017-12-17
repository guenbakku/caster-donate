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
    $("select.image-picker").imagepicker({
        hide_select:  false,
        show_label: true
    });
    
    //
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    
    function initAudio(){
        var audio, dir, ext, mylist;
        dir = "audio/";
        ext = ".mp3";
        // Audio Object
        audio = new Audio();
        audio.src = dir+"Jam_On_It"+ext;
        audio.play();
        // Event Handling
        mylist = document.getElementById("mylist");
        mylist.addEventListener("change", changeTrack);
        // Functions
        function changeTrack(event){
            audio.src = event.target.value;
            audio.play();
        }
    }
    window.addEventListener("load", initAudio);
});
</script>
<script>
    function testAnim(effect,target) {
        $('#'+target).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });
    };
    $(document).ready(function () {
        $('.js--triggerAnimation').click(function (e) {
            e.preventDefault();
            var anim = $('#'+$(this).data('value')).val();
            var target = $(this).data('target');
            testAnim(anim,target);
        });
        $('.js--animations').change(function () {
            var anim = $(this).val();
            var target = $(this).data('target');
            testAnim(anim,target);
        });
        $('#alert-donate-preview-button').click(function(e){
            var m1 = $('#message1').html();
            var m2 = $('#message2').html();
            var m3 = $('#message3').html();
            var m4 = $('#message4').html();
            var t1 = $('#target1').html();
            var t2 = $('#target2').html();
            var t3 = $('#target3').html();
            $('.alert-donate-thank-you')
                .css('color',$('input.colorpicker').val())
                .html(m1 + t1 + m2 + t2 + m3 + t3 + m4);
            $('.alert-donate-message').css('color',$('input.colorpicker').val());
        });
    });

    //
    $("input[name='tch3_22']").TouchSpin({
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
                <div class="white-box text-center" id="alert-donate-box">
                    <img class="alert-donate-image" width="100" height="100" src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D">
                    <p class="alert-donate-thank-you text-center"></p>
                    <p class="alert-donate-message text-center"></p>
                    <!-- 
                    //
                    //
                    -->
                </div>
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
            <?=$this->Form->create(null, [
                'type' => 'put',
                'class' => 'form-horizontal',
            ]);?>
            <section>
                <div class="sttabs tabs-style-iconbox">
                    <nav>
                        <ul>
                            <li class=""><a href="#section-iconbox-1" class="sticon mdi mdi-message-text"><span><?=__('Thông điệp')?></span></a></li>
                            <li class=""><a href="#section-iconbox-2" class="sticon mdi mdi-image-area"><span><?=__('Chọn hình ảnh')?></span></a></li>
                            <li class=""><a href="#section-iconbox-3" class="sticon mdi mdi-audiobook"><span><?=__('Chọn âm báo')?></span></a></li>
                            <li class=""><a href="#section-iconbox-4" class="sticon mdi mdi-blur"><span><?=__('Chọn hiệu ứng chữ')?></span></a></li>
                            <li class=""><a href="#section-iconbox-5" class="sticon mdi mdi-clock"><span><?=__('Thời gian hiển thị')?></span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap">


                        <section id="section-iconbox-1" class="">
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
                        </section>




                        <section id="section-iconbox-2" class="">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('Sử dụng hình ảnh của riêng bạn.')?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="dropify-wrapper">
                                            <div class="dropify-message">
                                                <span class="file-icon"></span> 
                                                <p>Drag and drop a file here or click</p>
                                                <p class="dropify-error">Ooops, something wrong appended.</p>
                                            </div>
                                            <div class="dropify-loader"></div>
                                            <div class="dropify-errors-container">
                                                <ul></ul>
                                            </div>
                                            <input type="file" id="input-file-now" class="dropify">
                                            <button type="button" class="dropify-clear">Remove</button>
                                            <div class="dropify-preview">
                                                <span class="dropify-render"></span>
                                                <div class="dropify-infos">
                                                    <div class="dropify-infos-inner">
                                                        <p class="dropify-filename">
                                                            <span class="file-icon"></span> 
                                                            <span class="dropify-filename-inner"></span>
                                                        </p>
                                                        <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('hoặc lựa chọn tài nguyên sẵn có')?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <select class="form-control image-picker">
                                            <option data-img-src="https://cdn.cloudpix.co/images/liam-neeson/liam-neeson-wallpaper-d4456958a1ebe442be628ce48434fc89-large-1304324.jpg" value="1">Cute Kitten 1</option>
                                            <option data-img-src="https://images.unsplash.com/photo-1485811055483-1c09e64d4576?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="2">Cute Kitten 2</option>
                                            <option data-img-src="http://placekitten.com/400/150" value="3">Cute Kitten 3</option>
                                            <option data-img-src="http://placekitten.com/450/151" value="4">Cute Kitten 4</option>
                                            <option data-img-src="https://images.unsplash.com/photo-1468436139062-f60a71c5c892?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="5">Cute Kitten 5</option>
                                            <option data-img-src="https://images.unsplash.com/photo-1504889270807-ccd74713ad45?auto=format&fit=crop&w=634&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="6">Cute Kitten 6</option>
                                            <option data-img-src="https://images.unsplash.com/photo-1476493279419-b785d41e38d8?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="7">Cute Kitten 7</option>
                                            <option data-img-src="https://images.unsplash.com/photo-1510253782297-404c4da27214?auto=format&fit=crop&w=1351&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="8">Cute Kitten 8</option>
                                            <option data-img-src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" value="9">Cute Kitten 9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section>




                        <section id="section-iconbox-3" class="">
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('Sử dụng file của bạn')?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="dropify-wrapper">
                                            <div class="dropify-message">
                                                <span class="file-icon"></span> 
                                                <p>Drag and drop a file here or click</p>
                                                <p class="dropify-error">Ooops, something wrong appended.</p>
                                            </div>
                                            <div class="dropify-loader">
                                            </div>
                                            <div class="dropify-errors-container">
                                            </div>
                                            <input type="file" id="input-file-now" class="dropify">
                                            <button type="button" class="dropify-clear">Remove</button>
                                            <div class="dropify-preview">
                                                <span class="dropify-render"></span>
                                                <div class="dropify-infos">
                                                    <div class="dropify-infos-inner">
                                                        <p class="dropify-filename">
                                                            <span class="file-icon"></span> 
                                                            <span class="dropify-filename-inner"></span>
                                                        </p>
                                                        <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('hoặc sử dụng tài nguyên sẵn có')?></label>
                                <div class="col-sm-9">
                                    <select class="form-control my-designed-scrollbar" id="mylist" size="4">
                                    <option value="https://freemusicarchive.org/file/music/Creative_Commons/Podington_Bear/Piano_IV_Cinematic/Podington_Bear_-_Bittersweet.mp3">Jam On It</option>
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
                        </section>




                        <section id="section-iconbox-4" class="">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('Hiệu ứng xuất hiện')?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select id="animationValue1" class="form-control js--animations" data-target="animationSandbox1">
                                                    <optgroup label="Attention Seekers">
                                                        <option value="bounce">bounce</option>
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
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info js--triggerAnimation" type="button" data-value="animationValue1" data-target="animationSandbox1"><?=__('Thử')?></button>
                                                </span> 
                                            </div>
                                        </div>

                                        <div class="col-sm-4 text-center"> 
                                            <span id="animationSandbox1" style="display: block;" class="">
                                                <img width="100" height="100" src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D">
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
                                            <div class="input-group">
                                                <select id="animationValue2" class="form-control js--animations" data-target="animationSandbox2">
                                                    <optgroup label="Bouncing Exits">
                                                        <option value="bounceOut">bounceOut</option>
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
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info js--triggerAnimation" type="button" data-value="animationValue2" data-target="animationSandbox2"><?=__('Thử')?></button>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-center"> 
                                            <span id="animationSandbox2" style="display: block;" class="">
                                                <img width="100" height="100" src="https://images.unsplash.com/photo-1473115209096-e0375dd6b3b3?auto=format&fit=crop&w=1350&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D">
                                            </span> 
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('Màu chữ thông báo')?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="colorpicker form-control" value="#ff7676" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?=__('Màu chữ lời nhắn')?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="colorpicker form-control" value="#ffffff" />
                                </div>
                            </div>
                        </section>




                        <section id="section-iconbox-5">
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-6">
                                    <input id="tch3_22" type="text" value="10" name="tch3_22" data-bts-button-down-class="btn btn-default btn-outline" data-bts-button-up-class="btn btn-default btn-outline"> 
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