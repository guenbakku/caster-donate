<?php
use Cake\Utility\Hash;
?>
<div class="white-box">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <?=$this->Html->tableHeaders(
                    [__('Tiêu đề'),__('Ngày tạo'),__('Thể loại'),__('Tình trạng')]
                );?>
            </thead>
            <tbody>
                <?php
                foreach($notifications as $notification)
                {
                    $notification->seen ? $attr= [] : $attr = [
                        'class' => 'text-success',
                        'onclick' => 'document.location = "'.$notification->notification_template->path.'"', 
                        'style' => 'cursor: pointer'
                    ];
                    echo $this->Html->tableCells(
                        [
                            $notification->notification_template->content,
                            $notification->modified,
                            sprintf(
                                '<span class="label label-%s">%s</span>',
                                $notification->notification_template->notification_type->color_class,
                                $notification->notification_template->notification_type->name 
                            ),
                            $notification->seen ? __('Đã đọc') : '',
                        ],
                        $attr,//lẻ
                        $attr//chẵn
                    );
                }
                ?>
            </tbody>
        </table>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>
            <button type="button" class="btn btn-default waves-effect">1</button>
            <button type="button" class="btn btn-default waves-effect">2</button>
            <button type="button" class="btn btn-default waves-effect">3</button>
            <button type="button" class="btn btn-default waves-effect">4</button>
            <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>
        </div>
    </div>
</div>