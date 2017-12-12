<?php 
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Collection\Collection;

$rootView->append('script');
?>

<script type="text/javascript">
    (function ($) {
        var elemId = '<?= $input['id'] ?>';
        var transport = <?= json_encode($transport) ?>;
        var select2Option= <?= json_encode($select2Option) ?>;
        var resultLayout= <?= json_encode($resultLayout) ?>;
        
        var multipleSelect = $('#'+elemId);
        <?php 
        if($transport['jump'] != null)
        {?>
            multipleSelect.on("select2:selecting", function(e) { 
            });            
        <?php
        }?>
        var ajaxOption =    {
            ajax: {
                url: transport['read'],
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {results: data};
                },
            },
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                }
            },
        }
        multipleSelect.select2(
            Object.assign(ajaxOption,{
                escapeMarkup: function (markup) { return markup; }, // let custom formatter work
                <?php
                foreach($resultLayout as $key => $value)
                {
                    echo ($value != null) ? "{$key}:{$value}," : '';
                }
                ?>
                },
                select2Option
            )
        );

        // Retrieve pre-selected values
        <?php if($transport['preSelected'] != null)
        {?>
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: transport['preSelected'],
            }).then(function (data) {
                $.each(data, function (index, item) {
                    var option = new Option(item.text, item.id, true, true);
                    multipleSelect.append(option).trigger('change');
                
                    // manually trigger the `select2:select` event
                    multipleSelect.trigger({
                        type: 'select2:select',
                        params: {
                            data: item
                        }
                    });
                });
            });
        <?php } ?>
    })(jQuery);
    
</script>
                
<?php $rootView->end() ?>

<?= $rootView->Form->control($input['name'], [
    'type' => 'select',
    'multiple' => true,
    'id' => $input['id'],
    'class' => $input['class'],
    'label' => $input['label'],
]) ?>



