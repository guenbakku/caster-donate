<?php 
use Cake\Collection\Collection;

$collection = new Collection($tags);
$collection = $collection->map(function ($val, $index) {
    return [
        'id' => $val->caster_tag->id,
        'text' => $val->caster_tag->name,
    ];
});

echo json_encode($collection->toArray());
