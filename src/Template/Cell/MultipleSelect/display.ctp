<?php 
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Collection\Collection;

$rootView->append('script');
?>

<script type="text/javascript">
    (function ($) {
        // Get preselected values
        var multipleSelect = $('#<?= $input['id'] ?>');

        multipleSelect.select2({
            ajax: {
                url: '<?= $transport['read'] ?>',
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
            minimumInputLength: 2,
            tags: true, // Enable dynamic creation
            tokenSeparators: [','],
            language: 'vi',
        });

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '<?= $transport['preSelected'] ?>',
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



