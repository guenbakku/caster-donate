'use strict';

function Select2MyResultFormat (repo) {
    if (repo.loading) {
        return repo.text;
    }
    var typing_text = $(".select2-search__field").val();

    var markup = "<a href='"+ repo.jumplink +"'><div class='clearfix' style='padding: 10px;width: 100%;'>" +
        "<div class='select2-result-avatar'>"+ repo.avatar +"</div>" +
        "<div class='select2-result-meta'>" +
        "<div class='select2-result-nickname'><u>" + 
            boldingKeyword(typing_text, repo.username) + 
            ' - ' +
            boldingKeyword(typing_text, repo.nickname) + 
        "</u></div>";

    var div_facebook = '';
    if($.trim(repo.facebook).length > 0)
    {
        var div_facebook = "<div><i class='fa fa-facebook'></i> " + boldingKeyword(typing_text, repo.facebook) + "</div>";
    }
    
    markup += "<div class='select2-result-statistics'>"  + div_facebook +  "</div>" +
    "</div></div></a>";

    return markup;
}

function boldingKeyword(key,text)
{
    /* 'i' : không phân biệt chữ hoa chữ thường
    xem thêm tại https://www.w3schools.com/jsref/jsref_obj_regexp.asp
    */
    return text.replace(new RegExp(key,'i'), '<strong>$&</strong>');
}
