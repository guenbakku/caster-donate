'use strict';

$(function () {
    $('.confirm').click(function (evt) {
        var msg = $(evt.target).data('confirm-message');
        return confirm(msg);
    });
});

