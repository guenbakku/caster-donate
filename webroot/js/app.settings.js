
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});

$(function () {
    kendo.culture("vi-VN");
    $('.dateinput').kendoDateInput();
})

$( function() {
    $( "#tags_autocomplete" ).autocomplete({
        source: function( request, response ) {
            $.ajax( {
                url: "http://caster-donate.cnmp7.vagrant/ajax-listener/auto-complete-tag/" + $('#tags_autocomplete').val(),
                success: function( data ) {
                    response( data.tag_name_array );
                }
            } );
        },
        minLength: 2
    });
});