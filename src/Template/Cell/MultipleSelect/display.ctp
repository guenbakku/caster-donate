<?php 
use Cake\Core\Configure;
use Cake\Utility\Hash;

$rootView->start('script');
echo $rootView->fetch('script');
?>

<script type="text/javascript">

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
                    url: '<?= Hash::get($options, 'readUrl') ?>',
                },
                create: {
                    url: '<?= Hash::get($options, 'createUrl') ?>',
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
            footerTemplate: $("#footerTemplate").html(),
            autoBind: false,
            dataTextField: "name",
            dataValueField: "number",
            dataSource: dataSource,
            noDataTemplate: $("#noDataTemplate").html(),
            value: JSON.parse($("#AuthorTags").html())
        });

        $('#edit-tag-form').submit(function(eventObj) {
            $('#edit-tag-form input[name=multiselectTagData]')
                .attr('value', JSON.stringify($("#tags").data("kendoMultiSelect").dataItems()))
                .appendTo('#edit-tag-form');
            return true;
        });
    });

</script>

<?php $rootView->end() ?>

<script id="noDataTemplate" type="text/x-kendo-tmpl">
    <?=__('Không tìm thấy dữ liệu')?>                            
</script>
<script id="footerTemplate" type="text/x-kendo-template">
    <button class="k-button btn btn-default btn-block" onclick="addNew('#: instance.element[0].id #', '#: instance.input.val() #')"><?=__('Tạo tag ')?> &nbsp;<b>#: instance.input.val() #</b></button>
</script>

<?=$this->Form->input('multiselectTagData', [
    'type' => 'text',
    'id' => 'tags',
    'label' => false
])?>

<?php 
    $tag_array = [] ;
    foreach(Hash::get($options, 'value', []) as $tag)
    {
        $tag_array[] = [
            "number"  => preg_replace('/[^0-9]/', '', $tag->id),
            "tag_id"  => h($tag->id),
            "name" => h($tag->name),
        ];
    }
?>
<div id="AuthorTags" style="display:none"><?=json_encode($tag_array)?></div>

