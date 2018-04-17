<?php
use Cake\Utility\Hash;
?>
<div class="white-box">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <?=$this->Html->tableHeaders(
                    ['Tiêu đề','Ngày tạo','Thể loại','Tình trạng']
                );?>
            </thead>
            <tbody>
                <?php
                $tableList = $this->Code->setTable('notification_types');
                foreach($notifications as $notification)
                {
                    $notification['seen'] ? $attr= [] : $attr = ['class' => 'text-success'];
                    echo $this->Html->tableCells(
                        [
                            $notification['title'],
                            $notification['modified'],
                            sprintf(
                                '<span class="label label-%s">%s</span>',
                                Hash::get($tableList->getList(['valueField' => 'color_class']), $notification['type_id']),
                                Hash::get($tableList->getList(), $notification['type_id'])
                            ),
                            $notification['seen']?'Đã đọc':'',
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