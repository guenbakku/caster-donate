//= require "packages/x-editable/js/bootstrap-editable.min.js"
//= require "packages/Touchspin/js/jquery.bootstrap-touchspin.min.js"
//= require "packages/jquery-asColorPicker-master/js/jquery-asColor.js"
//= require "packages/jquery-asColorPicker-master/js/jquery-asGradient.js"
//= require "packages/jquery-asColorPicker-master/js/jquery-asColorPicker.min.js"

;(function (global, factory){
    global.DonationNotificationSettings = factory(jQuery);
}(this, (function ($) {

'use strict';

var CONFIG = {
    audio: null,
    anime_handle: null,
    image_input: null,
    audio_input: null,
    textColor1: null,
    textColor2: null,
    appearEffect: null,
    disappearEffect: null,
    time_input: null,
    notify_message_array: null,
    notify_box: null,
    notify_box_image: null
};

function run (config)
{
    $.extend(CONFIG, config);

    $(document).ready(function () {
        $('#image_resources_preview').attr('src',CONFIG.image_input.find(":selected").data('url'));
        $('#message1').html(CONFIG.notify_message_array.message1);
        $('#message2').html(CONFIG.notify_message_array.message2);
        $('#message3').html(CONFIG.notify_message_array.message3);
        $('#message4').html(CONFIG.notify_message_array.message4);
        $('#target1').html(CONFIG.notify_message_array.target1);
        $('#target2').html(CONFIG.notify_message_array.target2);
        $('#target3').html(CONFIG.notify_message_array.target3);
        $('.editable[data-type="text"]').editable({
            type: 'text',
            emptytext: '___',
            pk: 1, 
            name: 'username', 
        });
        $('.editable[data-type="select"]').editable({
            prepend: "「___」",
            source: [
                {value: 1, text: '「Người ủng hộ」'},
                {value: 2, text: '「Số tiền」'},
            ]
        });
        CONFIG.time_input.TouchSpin({
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
    $(CONFIG.image_input).change(function() {
        $('#image_resources_preview').attr('src',CONFIG.image_input.find(":selected").data('url'));
    });
    $('#alert-donate-preview-button').click(function(e){
        clearTimeout(CONFIG.anime_handle);
        //cập nhật text
        var notify_message = getNotifyMsg('string');
        $('.alert-donate-thank-you')
            .css('color', CONFIG.textColor1.val())
            .html(replaceMessage(notify_message));
        $('.alert-donate-message')
            .css('color', CONFIG.textColor2.val())
            .html('Chúc bạn có buổi LiveStream vui vẻ.');
        //cập nhật hình ảnh
        CONFIG.notify_box_image.attr('src',CONFIG.image_input.find(":selected").data('url'));        
        //cập nhật âm thanh
        CONFIG.audio.pause();
        CONFIG.audio.currentTime = 0;
        CONFIG.audio.src = CONFIG.audio_input.find(":selected").data('url');
        CONFIG.audio.play();        
        //biểu diễn hiệu ứng
        previewAnimation(CONFIG.appearEffect.val(), '#'+CONFIG.notify_box.attr('id'));
        CONFIG.anime_handle = setTimeout(
            function() 
            {
                CONFIG.notify_box.delay( 800 ).removeClass().addClass(CONFIG.disappearEffect.val() + ' animated').one(
                    'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', 
                    function () {
                        CONFIG.audio.pause();
                        CONFIG.audio.currentTime = 0;
                    }
                );
            }, 
            CONFIG.time_input.val() * 1000
        );
    });
    $('#save-setting-button').click(function(e){
        $('<input />').attr('type', 'hidden')
                .attr('name', "notify_message_array")
                .attr('value', JSON.stringify(getNotifyMsg('array')))
                .appendTo("#form-donate-setting");
        $("#form-donate-setting").submit();
    });
}

function updateImageResourceAfterUpload(response){
    $('div').find('[data-image-private=true]').remove();
    var dom = $('<option>',{
            'data-image-private': true,
            'data-url': response.data.url,
            value: response.data.id,
        }).text(response.data.name);//hàm text đã thực hiện escape xxs
    $('#image_resources').prepend(dom);
    $('option[data-image-private=true]').prop('selected', true);
    $('#image_resources_preview').attr('src',CONFIG.image_input.find(":selected").data('url'));
}
 
function updateAudioResourceAfterUpload(response){
    $('div').find('[data-audio-private=true]').remove();
    var dom = $('<option>',{
            'data-audio-private': true,
            'data-url': response.data.url,
            value: response.data.id,
        }).text(response.data.name);//hàm text đã thực hiện escape xxs
    $('#audio_resources').prepend(dom);
    $('option[data-audio-private=true]').prop('selected', true);
}

function previewAnimation(effect,target) {
    $(target).finish();
    $(target).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
        $(this).removeClass();
    });
};

/*
 *   @param {string} returnType : trả về chuỗi string ('string') hay array('array')
 */
function getNotifyMsg(returnType)
{
    var m1 = $('#message1').html();
    var m2 = $('#message2').html();
    var m3 = $('#message3').html();
    var m4 = $('#message4').html();
    var t1 = $('#target1').html();
    var t2 = $('#target2').html();
    var t3 = $('#target3').html();
    var text = '';
    if(returnType == 'string'){
        text = m1 + ' ' + t1 + ' ' + m2 + ' ' + t2 + ' ' + m3 + ' ' + t3 + ' ' + m4;
        return text;
    }else if(returnType == 'array'){
        var array = {
            'message1'  : $('#message1').html(),
            'message2'  : $('#message2').html(),
            'message3'  : $('#message3').html(),
            'message4'  : $('#message4').html(),
            'target1'  : $('#target1').html(),
            'target2'  : $('#target2').html(),
            'target3'  : $('#target3').html(),
        };
        return array;
    }
    return '';
}

function replaceMessage(text){
    var f = ['「Người ủng hộ」','「Số tiền」','「___」','_'];
    var r = ['<strong>Nguyễn Văn A</strong>','<strong>10.000</strong>','',''];
    $.each(f,function(i,v) {
        var myregexp = new RegExp(v,'g');
        text = text.replace(myregexp,r[i]);
    });
    return text;
}

// Mock all into one
var hooks = {};
hooks.run = run;
hooks.updateImageResourceAfterUpload = updateImageResourceAfterUpload;
hooks.updateAudioResourceAfterUpload = updateAudioResourceAfterUpload;

return hooks;
    
})))