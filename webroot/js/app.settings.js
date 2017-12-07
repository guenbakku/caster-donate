'use strict';
function Select2MyResultFormat (repo) {
    if (repo.loading) {
        return repo.text;
    }
    var typing_text = $(".select2-search__field").val();

    if($.trim(repo.fullname).length > 0)
    {
        repo.fullname = " - " + repo.fullname;
    }
    var markup = "<div class='clearfix'>" +
        "<div class='select2-result-avatar'>"+ repo.avatar +"</div>" +
        "<div class='select2-result-meta'>" +
        "<div class='select2-result-nickname'>" + boldingKeyword(typing_text, repo.nickname) + boldingKeyword(typing_text, repo.fullname) + "</div>";

    

    var div_facebook = '';
    if($.trim(repo.facebook).length > 0)
    {
        var div_facebook = "<div><i class='fa fa-facebook'></i> " + boldingKeyword(typing_text, repo.facebook) + "</div>";
    }
    
    markup += "<div class='select2-result-statistics'>"  + div_facebook +  "</div>" +
    "</div></div>";

    return markup;
}

function boldingKeyword(key,text)
{
    /* 'i' : không phân biệt chữ hoa chữ thường
    xem thêm tại https://www.w3schools.com/jsref/jsref_obj_regexp.asp
    */
    return text.replace(new RegExp(key,'i'), '<strong>$&</strong>');
}