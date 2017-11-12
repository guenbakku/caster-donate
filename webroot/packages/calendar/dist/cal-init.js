
!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$categoryForm = $('#add-new-event form'),
        this.$extEvents = $('#calendar-events'),
        this.$modal = $('#my-event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
        // retrieve the dropped element's stored Event Object
        var originalEventObject = eventObj.data('eventObject');
        var $categoryClass = eventObj.attr('data-class');
        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);
        // assign it the date that was reported
        copiedEventObject.start = date;
        if ($categoryClass) copiedEventObject['className'] = [$categoryClass];
        copiedEventObject['isNew'] = true;
        // render the event on the calendar
        $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
    },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
        var form = $("<form></form>");
        form.append("<label>Đổi tên Event</label>");
        form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Lưu</button></span></div>");
        $this.$modal.modal({
            backdrop: 'static'
        });
        $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
            $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                return (ev._id == calEvent._id);
            });
            $this.$modal.modal('hide');
        });
        $this.$modal.find('form').on('submit', function () {
            calEvent.title = form.find("input[type=text]").val();
            $this.$calendarObj.fullCalendar('updateEvent', calEvent);
            $this.$modal.modal('hide');
            return false;
        });
    },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, resource) {
        var $this = this;
        $this.$modal.modal({
            backdrop: 'static'
        });
        var form = $("<form></form>");
        form.append("<div class='row'></div>");
        form.find(".row")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Tên Sự Kiện</label><input class='form-control' placeholder='Nhập tên' type='text' name='title'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Nhóm màu</label><select class='form-control' name='category'></select></div></div>")
            .find("select[name='category']")
            .append("<option value='bg-danger'>Đỏ</option>")
            .append("<option value='bg-success'>Xanh lá</option>")
            .append("<option value='bg-purple'>Tím</option>")
            .append("<option value='bg-info'>Xanh nước biển</option>")
            .append("<option value='bg-warning'>Vàng</option></div></div>")
            .append("<option value='bg-inverse'>Xám</option>");
        $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
            form.submit();
        });
        $this.$modal.find('form').on('submit', function () {
            var title = form.find("input[name='title']").val();
            var categoryClass = form.find("select[name='category'] option:checked").val();
            if (title !== null && title.length != 0) {
                $this.$calendarObj.fullCalendar('renderEvent', {
                    title: title,
                    start: start,
                    end: end,
                    isNew: true,
                    className: categoryClass
                }, true);
                $this.$modal.modal('hide');

                
            }
            else{
                alert('Bạn phải nhập tiêu đề cho sự kiện của bạn');
            }
            return false;
        });
        $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0,  //  original position after the drag
            });
        });
    }
    /* Initializing */
    CalendarApp.prototype.init = function() {
        this.enableDrag();
        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());

        var defaultEvents =  $.parseJSON($('#eventResources').html());
        //convert string thành time
        $.each(defaultEvents, function (index, value) {
            value.end = new Date(value.end);
            value.start = new Date(value.start);
        });
        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:30:00',
            minTime: '00:00:00',
            maxTime: '24:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,             
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: true,
            droppable: true,
            eventLimit: true,
            selectable: true,
            defaultTimedEventDuration: '02:00:00',
            drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, resource) {  $this.onSelect(start, end, resource);},
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }
        });

        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                var $extEventTable = $this.$extEvents.find("table");
                $extEventTable.append('<tr class="label-rows"></tr>');
                $extEventTable.find("tr:last").append('<td><div class="calendar-events ui-draggable ui-draggable-handle" data-class="bg-' + categoryColor + '" data-id="" data-color="' + categoryColor + '" style="position: relative;"><i class="fa fa-circle text-' + categoryColor + '"></i> <span class="label-title">' + categoryName + '</span></td>');
                $extEventTable.find("tr:last").append('<td class="w20p"><button type="button" class="btn btn-circle btn-info btn-outline"><i class="ti-trash"></i></button></td>');
                $this.enableDrag();
            }
        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),



$(function() {
    "use strict";
    //initializing CalendarApp
    $.CalendarApp.init();
    
    //kích hoạt button xóa nhãn sự kiện
    $(document).on("click", ".label-rows button", function() {
        $(this).parents("tr").fadeOut("fast").remove();
    });

    //tạo array dữ liệu cho event và label trước khi POST
    $("#form-update-schedule").submit( function(eventObj){
        // eventObj.preventDefault();
        //event
        var data = $('#calendar').fullCalendar('clientEvents');
        var event_datas = new Array();
        data.forEach(function(element, index, array){
            var a = new Array();
            a['title'] = element.title;
            event_datas[index] = {
                title: element.title, 
                id: element._id,
                isNew: element.isNew,
                allDay: element.allDay,
                start: $.fullCalendar.formatDate(element.start, "YYYY-MM-DD HH:mm:ss"), 
                end: (element.end == null) ? null : $.fullCalendar.formatDate(element.end, "YYYY-MM-DD HH:mm:ss"), 
                className: JSON.stringify(element.className)
            };
        });
        $('input[name="event-datas"]').val(JSON.stringify(event_datas));
        //event-label
        var event_labels = new Array();
        $('.calendar-events').each(function(){
            event_labels.unshift({
                id : $(this).data('id'),
                title : $(this).find('.label-title').html(),
                color : $(this).data('color'),
                classes : $(this).data('class'),
            });
        });
        $('input[name="event-labels"]').val(JSON.stringify(event_labels));
    });
});