<?php
echo $this->Html->css('/packages/calendar/dist/fullcalendar.css', ['block'=>true]);
echo $this->AssetCompress->script('Me.Schedules.calendar.js', ['block' => 'script']);
?>

<div class="row">
    <div class="col-md-3">
        <div id="eventResources" style="display:none"><?=$eventDatas?></div>
        <div class="white-box">
            <?=$this->Form->create(null, [
                'type' => 'put',
                'url' => $this->Url->build(['prefix'=>'me','controller'=>'schedules','action'=>'edit']),
                'id' => 'form-update-schedule'
            ]);?>
            <?=$this->Form->control('event-datas', [
                'label' => false,
                'class' => 'hidden',
                'value' => 'null'
            ]);?>
            <?=$this->Form->control('event-labels', [
                'label' => false,
                'class' => 'hidden',
                'value' => 'null'
            ]);?>
            <?=$this->Form->button('<i class="fa fa-check"></i> Cập nhật lịch', [
                'type'  => 'submit',
                'id' => false,
                'class' => 'fcbtn btn btn-lg btn-block btn-outline btn-success',
            ]);?>
            <?= $this->Form->end()?>
        </div>
        <div class="white-box">
            <h3 class="box-title"><?=__('Nhãn sự kiện thường dùng')?></h3>
            <p class="text-muted"><?=__('Kéo và thả sự kiện vào lịch')?></p>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="calendar-events" class="m-t-20">
                        <table class="table">
                        <?php
                        foreach($labelDatas as $label)
                        {
                            printf('
                            <tr class="label-rows">
                                <td>
                                    <div class="calendar-events ui-draggable ui-draggable-handle" data-class="%s" data-id="%s" data-color="%s" style="position: relative;">
                                    <i class="fa fa-circle text-%s"></i> <span class="label-title">%s</span>
                                </td>
                                <td class="w10p">
                                    <button type="button" class="btn btn-circle btn-info btn-outline"><i class="ti-trash"></i></button>
                                </td>
                            </tr>',$label['classes'],$label['id'],$label['color'],$label['color'],$label['title']);
                        }
                        ?>
                        </table>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#add-new-event" class="btn btn-lg m-t-40 fcbtn btn-block btn-outline btn-info">
                        <i class="ti-plus"></i> <?=__('Thêm nhãn sự kiện')?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="white-box">
            <div id="calendar" class="fc fc-unthemed fc-ltr">
            </div>
        </div>
    </div>
</div>

<!-- BEGIN MODAL -->
<div class="modal fade none-border" id="my-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong><?=__('Thêm sự kiện')?></strong></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="fcbtn btn btn-outline" data-dismiss="modal"><?=__('Đóng')?></button>
                <button type="button" class="fcbtn btn btn-outline btn-info save-event"><?=__('Tạo')?></button>
                <button type="button" class="fcbtn btn btn-outline btn-danger delete-event" data-dismiss="modal"><i class="ti-trash"></i> <?=__('Xóa')?></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add Category -->
<div class="modal fade none-border" id="add-new-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?=__('Thêm thẻ sự kiện')?></h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label"><?=__('Tên thẻ')?></label>
                            <input class="form-control form-white" placeholder="Nhập tên" type="text" name="category-name"/>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label"><?=__('Chọn màu cho thẻ')?></label>
                            <select class="form-control form-white" data-placeholder="Chọn màu ..." name="category-color">
                                <option value="danger"><?=__('Đỏ')?></option>
                                <option value="success"><?=__('Xanh lá')?></option>
                                <option value="purple"><?=__('Tím')?></option>
                                <option value="info"><?=__('Xanh nước biển')?></option>
                                <option value="warning"><?=__('Vàng')?></option>
                                <option value="inverse"><?=__('Xám')?></option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="fcbtn btn btn-outline" data-dismiss="modal"><?=__('Đóng')?></button>
                <button type="button" class="fcbtn btn btn-outline btn-success save-category" data-dismiss="modal"><?=__('Thêm')?></button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->
