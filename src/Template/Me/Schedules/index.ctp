<?= $this->Html->css('/packages/calendar/dist/fullcalendar.css',['block'=>true]) ?>
<div class="row">
    <div class="col-md-3">
        <div class="white-box">
            <h3 class="box-title">Kéo và thả sự kiện vào lịch</h3>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div id="calendar-events" class="m-t-20">
                        <div class="calendar-events ui-draggable ui-draggable-handle" data-class="bg-info" style="position: relative;"><i class="fa fa-circle text-info"></i> My Event One</div>
                        <div class="calendar-events ui-draggable ui-draggable-handle" data-class="bg-success" style="position: relative;"><i class="fa fa-circle text-success"></i> My Event Two</div>
                        <div class="calendar-events ui-draggable ui-draggable-handle" data-class="bg-danger" style="position: relative;"><i class="fa fa-circle text-danger"></i> My Event Three</div>
                        <div class="calendar-events ui-draggable ui-draggable-handle" data-class="bg-warning" style="position: relative;"><i class="fa fa-circle text-warning"></i> My Event Four</div> 
                    </div>
                    <!-- checkbox -->
                    <div class="checkbox">
                        <input id="drop-remove" type="checkbox">
                        <label for="drop-remove">
                            Xóa sau khi thêm vào lịch
                        </label>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#add-new-event" class="btn btn-lg m-t-40 btn-danger btn-block waves-effect waves-light">
                        <i class="ti-plus"></i> Thêm sự kiện mới
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

<?= $this->Html->script('/packages/calendar/jquery-ui.min.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/moment/moment.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/fullcalendar.min.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/jquery.fullcalendar.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/locale/vi.js',['block'=>true]) ?>
<?= $this->Html->script('/packages/calendar/dist/cal-init.js',['block'=>true]) ?>