<?php
echo $this->AssetCompress->script('Me.Notification.index.js', ['block' => 'script']);
?>
<div class="white-box">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <?=$this->Html->tableHeaders(
                    [__('Tiêu đề'),__('Ngày tạo'),__('Thể loại'),__('Tình trạng')],
                    [],
                    ['class' => 'my-white']
                );?>
            </thead>
            <tbody>
                <?php
                foreach($notifications as $notification)
                {
                    $attr = [
                        'onclick' => 'document.location = "'.$this->Url->build(['action' => 'show-notification',$notification->id]).'"', 
                        'style' => 'cursor: pointer'
                    ];
                    $attr['class'] = $notification->seen ?  '' : 'text-success';
                    echo $this->Html->tableCells(
                        [
                            $notification->content,
                            $notification->created,
                            sprintf(
                                '<span class="label label-%s">%s</span>',
                                $notification->notification_template->notification_type->color_class,
                                $notification->notification_template->notification_type->name 
                            ),
                            $notification->seen ? __('Đã đọc') : __('Mới'),
                        ],
                        $attr,//lẻ
                        $attr//chẵn
                    );
                }
                ?>
            </tbody>
        </table>
        <button id="seen-button" class="btn btn-outline btn-success pull-left"><i class="fa fa-check"></i> <?=__('Đánh dấu đã đọc tất cả')?></button>
        <ul class="pagination m-b-0 m-t-0 pull-right">
            <?php echo $this->Paginator->numbers(['first' => 'First page']);?>
        </ul>
    </div>
</div>