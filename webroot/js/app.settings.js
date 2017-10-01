
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    $(':input').inputmask();
});

$(function () {
    kendo.culture("vi-VN");
})

$(function() {
    $("#products").kendoMultiSelect({
        placeholder: "Select products...",
        dataTextField: "ProductName",
        dataValueField: "ProductID",
        autoBind: false,
        dataSource: {
            type: "odata",
            serverFiltering: true,
            transport: {
                read: {
                    url: "/api/v1/tags/",
                }
            }
        },
        dataTextField: "name",
        dataValueField: "id"
    });
});