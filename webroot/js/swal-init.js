//= require "packages/sweetalert/sweetalert.min.js"

'use strict';

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
