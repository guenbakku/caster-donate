<?php 
use Cake\Collection\Collection;

$collection = new Collection($tags);
$collection = $collection->map(function ($val, $key) {
    return [
        'id' => $val->id,
        'text' => $val->name,
        'image' => $val->image,
    ];
});

echo json_encode($collection->toArray());
