<?php 
use Cake\I18n\FrozenTime;
?>
<li class="dropdown">
    <?php
    //hiển thị nút nhấp nháy nếu có thông báo
    $notify_point = $this->Html->div('notify', '');
    foreach($userNotifications as $notification)
    {
        if($notification['seen'] == false)
        {
            $notify_point = $this->Html->div('notify', '<span class="heartbit"></span><span class="point"></span>');
            break;
        } 
    }
    echo $this->Html->link(
        '<i class="mdi mdi-bell"></i>'.$notify_point,
        '#',
        [
            'class' => 'dropdown-toggle waves-effect waves-light',
            'data-toggle' => 'dropdown',
            'aria-expanded' => 'false',
            'escape' => false
        ]
    );
    //hiển thị các thông báo gần nhất
    $options = [];
    foreach($userNotifications as $notification)
    {
        $time = new FrozenTime($notification['created']);
        $options[] = $this->Html->link(
            $this->Html->div('col-xs-11 text-success', $notification['title']) . $this->Html->div('col-xs-1 text-success', $time->format('d/m')),
            '#',
            ['escape' => false]
        );
    }
    echo $this->Html->nestedList(
        array_merge(
            [$this->Html->div('drop-title text-center my-white', __('Thông báo'))], 
            $options,
            [$this->Html->link(__('Xem tất cả'),'/me/notification',['class' => 'text-center'])]
        ),
        ['class'=>'dropdown-menu dropdown-notifs animated bounceInDown','tag'=>'ul']
    ); 
    ?>    
</li>