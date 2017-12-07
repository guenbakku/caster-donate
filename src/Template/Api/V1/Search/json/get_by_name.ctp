<?php 
use Cake\Collection\Collection;

$collection = new Collection($SearchResult);
$collection = $collection->map(function ($val, $key) {
    return [
        'jumplink' => $this->Url->build('donate/'.$val->user_id,true),
        'nickname' => $val->nickname,
        'lastname' => $val->lastname,
        'firstname' => $val->firstname,
        'avatar' => $this->Html->image($val->avatar),
        'facebook' => $val->facebook,
        'fullname' => $val->fullname,
    ];
});

echo json_encode($collection->toArray());
