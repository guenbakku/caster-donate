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
    var markup = "<a href='"+ repo.jumplink +"'><div class='clearfix' style='padding: 10px;width: 100%;'>" +
        "<div class='select2-result-avatar'>"+ repo.avatar +"</div>" +
        "<div class='select2-result-meta'>" +
        "<div class='select2-result-nickname'><u>" + 
            boldingKeyword(typing_text, repo.nickname) + 
            boldingKeyword(typing_text, repo.fullname) + 
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


/*
**  SWEETALERT
** >>>>>>>>>>>>>>>>>>>>>START
*/
function swalAutoClose(title, timer = 1500 ,text = '')
{
    swal({   
        title: title,   
        text: text,   
        timer: timer,   
        showConfirmButton: false 
    });
}

function swalBasic(message = '')
{
    swal(message);
}

function swalTitle(title = '', message = '')
{
    swal(title, message);
}

function swalSuccess(title = '', message= '')
{
    swal(title, message, 'success');
}

function swalError(title = '', message= '')
{
    swal(title, message, 'error');
}

function swalWarning(title = '', message = '', confirmButtonText = 'Yes', successTitle = '', successMessage = '')
{
    swal({   
        title: title,   
        text: message,   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: confirmButtonText,   
        closeOnConfirm: false 
    }, function(){   
        swalSuccess(successTitle, successMessage); 
    });
}

function swalParams(title = '', message = '', confirmButtonText = 'Yes', cancelButtonText = 'No', successTitle = '', successMessage = '', canceledTitle = '', canceledMessage = '')
{
    swal({   
        title: title,   
        text: message,   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: confirmButtonText,   
        cancelButtonText: cancelButtonText,   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }, function(isConfirm){   
        if (isConfirm) {     
            swalSuccess(successTitle, successMessage);   
        } else {     
            swalError(canceledTitle, canceledMessage, "error");   
        } 
    });
}

function swalImage(title = '', message = '', imageUrl = false)
{
    swal({   
        title: title,   
        text: message,   
        imageUrl: imageUrl 
    });
}

/**
 * SWEETALERT
 * END<<<<<<<<<<<<<<<<<<<<<<<<<<
 */
