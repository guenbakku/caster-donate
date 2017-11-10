<?= $this->Html->css('/packages/calendar/dist/fullcalendar.css',['block'=>true]) ?>
<div class="row">
    <div class="col-md-3">
        <div id="eventResources" style="display:none"><?=$eventDatas?></div>
        <div class="white-box">
            <?=$this->Form->create(null, [
                'type' => 'put',
                'url' => '/me/schedules/edit',
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
            <?=$this->Form->button('Cập nhật lịch', [
                'type'  => 'submit',
                'id' => false,
                'class' => 'btn btn-lg btn-info btn-block waves-effect waves-light',
            ]);?>
            <?= $this->Form->end()?>
        </div>
        <div class="white-box">
            <h3 class="box-title">Nhóm sự kiện chính</h3>
            <p class="text-muted">Kéo và thả sự kiện vào lịch</p>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="calendar-events" class="m-t-20">
                        <?php
                        foreach($labelDatas as $label)
                        {
                            echo '<div class="calendar-events ui-draggable ui-draggable-handle" data-class="'.$label['className'].'" data-id="'.$label['id'].'" data-color="'.$label['color'].'" style="position: relative;">';
                            echo '<i class="fa fa-circle text-'.$label['color'].'"></i> <span class="label-title">'.$label['title'].'</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="col-md-3 m-t-20" id="trash">
                        <button class="btn btn-outline btn-default btn-lg"><i class="ti-trash" style="font-size:40px"></i></button>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#add-new-event" class="btn btn-lg m-t-40 btn-success btn-block waves-effect waves-light">
                        <i class="ti-plus"></i> Thêm nhóm sự kiện
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
                <h4 class="modal-title"><strong>Thêm sự kiện</strong></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light">Tạo</button>
                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Xóa</button>
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
                <h4 class="modal-title">Thêm thẻ sự kiện</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Tên thẻ</label>
                            <input class="form-control form-white" placeholder="Nhập tên" type="text" name="category-name"/>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Chọn màu cho thẻ</label>
                            <select class="form-control form-white" data-placeholder="Chọn màu ..." name="category-color">
                                <option value="danger">Đỏ</option>
                                <option value="success">Xanh lá</option>
                                <option value="purple">Tím</option>
                                <option value="info">Xanh nước biển</option>
                                <option value="warning">Vàng</option>
                                <option value="inverse">Xám</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Lưu</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->






<?= $this->Html->script('/packages/calendar/jquery-ui.min.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/moment/moment.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/fullcalendar.min.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/locale/vi.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/cal-init.js',['block'=>true]) ?>