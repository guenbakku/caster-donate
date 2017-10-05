
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
            number: 0,
            data_current_length: dataSource.data().length,//gửi số thứ tự
            name: value,
        }); 
        dataSource.one("requestEnd", function(args) {
            if (args.type !== "create") {
                return;
            }
            var newValue = args.response[0].number;

        $("#test").html(JSON.stringify(args)); 
            dataSource.one("sync", function() {
                widget.value(widget.value().concat([newValue]));
            });
        });
        dataSource.sync();
    }
}
$(function() {
    var crudServiceBaseUrl = "/api/v1/tags";
    var dataSource = new kendo.data.DataSource({
        batch: true,
        transport: {
            read:  {
                url: crudServiceBaseUrl +'/get-all',
            },
            create: {
                url: crudServiceBaseUrl + "/create",
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
                id: "number",
                fields: {
                    number: { type: "number" },
                    tag_id: { type: "string" },
                    name: { type: "string" }
                }
            }
        }
    });

    $("#tags").kendoMultiSelect({
        filter: "contains",//tìm trong nội dung, ngoài ra còn có "equal" và "startswith"
        autoBind: false,
        dataTextField: "name",
        dataValueField: "number",
        dataSource: dataSource,
        noDataTemplate: $("#noDataTemplate").html(),
        value: JSON.parse($("#AuthorTags").html())
    });
});

$(function(){
    $('#edit-tag-form').submit(function(eventObj) {
        $('#edit-tag-form input[name=multiselectTagData]')
            .attr('value', JSON.stringify($("#tags").data("kendoMultiSelect").dataItems()))
            .appendTo('#edit-tag-form');
        return true;
    });
});