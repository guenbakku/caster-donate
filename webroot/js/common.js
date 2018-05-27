$(function () {
    /**
     * Thêm class ".active" vào thẻ <li> trong block .nav-tabs
     */ 
    $(document).ready(function () {
        var url = window.location;
        var elements = $('ul.nav-tabs a').filter(function () {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }).parent().addClass('active');
    });

    /**
     * Thêm class ".active" vào thẻ <a> đầu tiên thuộc tab <li> đang active.
     * Điều kiện: li.active đã được xử lý trong file "packages/AmpleAdmin/custom.min.js"
     */
    $(document).ready(function () {
        var elements = $('ul.nav li.active > a');
        elements.addClass('active');
    });
})



