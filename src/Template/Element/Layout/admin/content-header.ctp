<?php 
$title = $this->ContentHeader->title('h4', ['page-title']);
if ($title !== null) { 
    $div = $this->Html->tag('div', $title, [
        'class' => 'col-lg-3 col-md-4 col-sm-4 col-xs-12',
        'escape' => false,
    ]);
    $div = $this->Html->tag('div', $div, [
        'class' => 'row bg-title',
        'escape' => false,
    ]);

    echo $div;
} 
?>
