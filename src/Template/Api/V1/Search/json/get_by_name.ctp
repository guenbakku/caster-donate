<?php 
use Cake\Collection\Collection;

$collection = new Collection($SearchResult);
$collection = $collection->map(function ($val, $key) {
    return [
        'nickname' => $val->nickname,
        'lastname' => $val->lastname,
        'firstname' => $val->firstname,
        'avatar' => $this->Html->image($val->avatar),
        // 'facebook' => json_encode($val),
        'facebook' => $val->facebook,
        'fullname' => $val->fullname,
    ];
});

echo json_encode($collection->toArray());
