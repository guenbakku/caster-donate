
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

function addNew(widgetId, value) {
    var widget = $("#" + widgetId).getKendoMultiSelect();
    var dataSource = widget.dataSource;

    if (confirm("Bạn muốn tạo tag mới ?")) {
        dataSource.add({
            order_id: 0,
            data_current_length: dataSource.data().length,//gửi số thứ tự
            tag_name: value
        });
        dataSource.one("requestEnd", function(args) {
            if (args.type !== "create") {
                return;
            }
            var newValue = args.response[0].order_id;

            dataSource.one("sync", function() {
                widget.value(widget.value().concat([newValue]));
            });
        });

        dataSource.sync();
    }
}
$(document).ready(function() {
    var crudServiceBaseUrl = "/api/v1/tags";
    var dataSource = new kendo.data.DataSource({
        batch: true,
        transport: {
            read:  {
                url: crudServiceBaseUrl +'/kendo-get-all',
            },
            create: {
                url: crudServiceBaseUrl + "/kendo-create",
            },
            parameterMap: function(options, operation) {
                if (operation !== "read" && options.models) {
                    //trao array {model: (obj)[name:""] } cho bên nhận create
                    return {models: kendo.stringify(options.models)};
                }
            }
        },
        schema: {
            model: {
                id: "order_id",
                fields: {
                    order_id: { type: "number" },
                    tag_name: { type: "string" }
                }
            }
        }
    });

    $("#products").kendoMultiSelect({
        filter: "contains",//tìm trong nội dung, ngoài ra còn có "equal" và "startswith"
        autoBind: false,
        dataTextField: "tag_name",
        dataValueField: "order_id",
        dataSource: dataSource,
        noDataTemplate: $("#noDataTemplate").html()
    });
});