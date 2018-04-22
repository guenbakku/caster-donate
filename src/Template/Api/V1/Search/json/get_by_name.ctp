<?php 
use Cake\Collection\Collection;

$collection = new Collection($SearchResult);
$collection = $collection->map(function ($val, $key) {
    return [
        'jumplink' => $this->Url->build(['prefix'=>null,'controller'=>'donate',$user_id], true),
        'nickname' => $val->nickname,
        'avatar' => $this->Html->image($val->avatar_url),
        'facebook' => $val->facebook,
        'username' => $val->user->username,
    ];
});

echo json_encode($collection->toArray());
