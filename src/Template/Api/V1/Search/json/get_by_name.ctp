<?php 
use Cake\Collection\Collection;

$collection = new Collection($SearchResult);
$collection = $collection->map(function ($val, $key) {
    return [
        'nickname' => $val->nickname,
        'lastname' => $val->lastname,
        'firstname' => $val->firstname,
        'avatar' => $this->Html->image($val->avatar),
    ];
});

echo json_encode($collection->toArray());
