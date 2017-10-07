<?php 
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Collection\Collection;

$rootView->start('script');
echo $rootView->fetch('script');
?>

<script type="text/javascript">

    function addNew(widgetId, value) {
        var widget = $("#" + widgetId).getKendoMultiSelect();
        var dataSource = widget.dataSource;
    
        if (confirm("Bạn muốn tạo tag mới ?")) {
            dataSource.add({
                id: 0,
                name: value,
            }); 

            dataSource.one("requestEnd", function(args) {
                if (args.type !== "create") {
                    return;
                }
                
                var newValue = args.response[0].id;

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
                    id: "id",
                    fields: {
                        id: { type: "string" },
                        name: { type: "string" }
                    }
                }
            }
        });

        $("#tags").kendoMultiSelect({
            filter: "contains", //tìm trong nội dung, ngoài ra còn có "equal" và "startswith"
            autoBind: false,
            dataTextField: "name",
            dataValueField: "id",
            dataSource: dataSource,
            footerTemplate: $("#footerTemplate").html(),
            noDataTemplate: $("#noDataTemplate").html(),
            value: JSON.parse($("#AuthorTags").html()),
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

<?= $this->Form->input('multiselectTagData', [
    'type' => 'text',
    'id' => 'tags',
    'label' => false
]) ?>

<?php 
    $Collection = new Collection(Hash::get($options, 'value', []));
    $tags = $Collection->map(function ($tag, $key) {
        return [
            'id' => h($tag->id),
            'name' => h($tag->name),
        ];
    })->toArray();
?>
<div id="AuthorTags" style="display:none"><?=json_encode($tags)?></div>

