
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
            id: 0,
            name: value
        });

        dataSource.one("requestEnd", function(args) {
            if (args.type !== "create") {
                return;
            }

            var newValue = args.response[0].ProductID;

            dataSource.one("sync", function() {
                widget.value(widget.value().concat([newValue]));
            });
        });

        dataSource.sync();
    }
}
$(document).ready(function() {
    var crudServiceBaseUrl = "http://caster-donate.cnmp7.vagrant/api/v1/tags";
    var dataSource = new kendo.data.DataSource({
        batch: true,
        transport: {
            read:  {
                url: crudServiceBaseUrl,
            },
            create: {
               /*  url: "https://demos.telerik.com/kendo-ui/service/Products/Create",
                dataType: "jsonp", */
                url: crudServiceBaseUrl + "/create",
            },
            parameterMap: function(options, operation) {
                if (operation !== "read" && options.models) {
                    return {models: kendo.stringify(options.models)};
                }
            }
        },
        schema: {
            model: {
                id: "ProductID",
                fields: {
                    ProductID: { type: "number" },
                    ProductName: { type: "string" }
                }
            }
        }
    });

    $("#products").kendoMultiSelect({
        filter: "contains",//tìm trong nội dung, ngoài ra còn có "equal" và "startswith"
        dataTextField: "name",
        dataValueField: "id",
        dataSource: dataSource,
        noDataTemplate: $("#noDataTemplate").html()
    });
});