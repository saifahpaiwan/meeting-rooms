@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('template/libs/tagify/tagify.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('template/libs/mobiscroll/css/mobiscroll.jquery.min.css') }}">
<style>
    .tagify {
        width: 100%;
        min-height: 100px;
        overflow: auto;
        align-content: flex-start;
        align-items: center;
    }

    .tagify__tag>div {
        padding: 0.15rem 0.5rem !important;
    }

    .tagify__tag>div::before {
        box-shadow: unset;
        background: #ddd;
    }

    .tagify__dropdown {
        position: absolute;
        z-index: 99999;
        transform: translateY(-1px);
        border-top: 1px solid var(--tagify-dd-color-primary);
        overflow:auto;
    }

    .dynamically-color-and-invalidate-calendar {
        border-left: 1px solid #ccc;
    }

    .dynamically-color-and-invalidate-task {
        border: 2px solid #888;
        color: #666;
        padding: 10px;
        margin: 20px;
        border-radius: 8px;
        font-family: -apple-system, Segoe UI, Roboto, sans-serif;
    }

    .dynamically-color-and-invalidate-task-type {
        float: right;
        margin-left: 30px;
        text-transform: uppercase;
    }

    .dynamically-color-and-invalidate-calendar .mbsc-timeline-parent {
        height: 32px;
    }

    .mbsc-font {
        font-family: unset;
    }

    .md-search-events-cont {
        width: 100%;
    }

    .md-search-events-cont .mbsc-textfield-wrapper.mbsc-ios {
        margin-top: 26px;
        margin-bottom: 26px;
    }

    .md-search-events-cont .mbsc-textfield-wrapper.mbsc-material {
        margin-top: 25px;
        margin-bottom: 26px;
    }

    .md-search-events-cont .mbsc-textfield-wrapper.mbsc-windows {
        margin-top: 34px;
        margin-bottom: 35px;
    }

    @media (min-width:1135px) {
        .md-search-events-cont .mbsc-textfield-wrapper.mbsc-windows {
            margin-top: 39px;
            margin-bottom: 40px;
        }
    }

    .md-search-events-calendar {
        border-left: 1px solid #ccc;
        overflow: hidden;
    }

    .demo-searching-events-in-sidebar,
    .md-search-events-sidebar,
    .md-search-events-calendar {
        height: 100%;
    }

    .users-shifts-day {
        font-size: 14px;
        font-weight: 600;
        opacity: .6;
    }

    .users-shifts-popup .mbsc-popup .mbsc-popup-header {
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .users-shifts-cont {
        position: relative;
        padding-left: 42px;
        max-height: 40px;
    }

    .users-shifts-avatar {
        position: absolute;
        max-height: 40px;
        max-width: 40px;
        top: 18px;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        left: 20px;
    }

    .users-shifts-name {
        font-size: 15px;
    }

    .users-shifts-title {
        font-size: 12px;
    }

    .md-users-shifts .mbsc-timeline-resource,
    .md-users-shifts .mbsc-timeline-resource-col {
        width: 200px;
        align-items: center;
        display: flex;
    }

    .md-users-shifts .mbsc-schedule-event {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 36px;
    }
</style>
@endsection

@section('content')
@include('include.page-title-box')

<div class="row">
    <div class="col-md-12">

        <div class="mbsc-grid mbsc-no-padding">
            <div class="mbsc-row">
                <div class="mbsc-col-sm-2 pl-1 bg-white">
                    <div class="md-search-events-sidebar mbsc-flex">
                        <div class="md-search-events-cont mbsc-flex-col mbsc-flex-none">
                            <label>
                                <input id="md-search-sidebar-demo-input" mbsc-input data-start-icon="material-search" data-input-style="outline" placeholder="Search events"></input>
                            </label>
                            <div id="demo-search-sidebar-list"></div>
                        </div>
                        <div class="md-search-events-calendar mbsc-flex-1-1">
                            <div id="demo-search-sidebar-events"></div>
                        </div>
                    </div>
                </div>
                <div class="mbsc-col-sm-10 dynamically-color-and-invalidate-calendar">
                    <div id="demo-dynamically-color-and-invalidate"></div>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- // ====================Popup Create Form======================= // -->
<div id="demo-users-shifts-popup" class="users-shifts-popup hide">
    <div class="mbsc-form-group">
        <label for="users-shifts-start">
            Strat Time
            <input mbsc-input data-dropdown="true" id="users-shifts-start" />
        </label>
        <label for="users-shifts-end">
            End Time
            <input mbsc-input data-dropdown="true" id="users-shifts-end" />
        </label>
        <div id="demo-users-shifts-date"></div>
    </div>
    <div class="mbsc-form-group">
        <label>
            หัวข้อการประชุม <span class="text-danger">*</span>
            <input mbsc-input id="work-order-title" />
        </label>
        <div style="margin: 1em;">
            <label style="font-size: .875em; font-weight: 600;"> ผู้จอง <span class="text-danger">*</span> </label>
            <select class="form-control" id="work-order-booker">
                <option value=""> โปรดเลือกข้อมูล </option>
                @if(isset($users) && count($users)>0)
                @foreach($users as $row)
                <option value="{{ $row->id }}"> {{ $row->email }}
                </option>
                @endforeach
                @endif
            </select>
        </div>
        <div style="margin: 1em;">
            <label style="font-size: .875em; font-weight: 600;"> ผู้เข้าร่วมการประชุม <span class="text-danger">*</span> </label>
            <div class="tags-default">
                <input type="text" class="form-control" name="send_to" id="send_to" placeholder="Add Meeting Participants" />
            </div>
        </div>
        <label>
            คำอธิบายการประชุม
            <textarea mbsc-textarea id="users-shifts-notes" placeholder="Description."></textarea>
        </label>
    </div>
    <div class="mbsc-button-group">
        <button class="mbsc-button-block" id="users-shifts-delete" mbsc-button data-color="danger" data-variant="outline">Delete shift</button>
    </div>
</div>
<!-- // ====================Popup Create Form======================= // -->
@endsection

@section('script')
<script src="{{ asset('template/libs/mobiscroll/js/mobiscroll.jquery.min.js') }}"></script>
<script src="{{ asset('template/libs/tagify/tagify.js') }}"></script>
<script>
    $('#booker_id').select2();
    $('#meeting_rooms_id').select2();

    $(function() {
        var inputSendTo = document.getElementById('send_to');
        var tagify;
        getWhitelist();

        function getWhitelist() {
            $.ajax({
                url: "{{ route('get.users') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);

                    var whitelist = response;
                    initTagify(whitelist);
                }
            });
        }

        function initTagify(whitelist) {
            if (!tagify) {
                tagify = new Tagify(inputSendTo, {
                    whitelist: whitelist
                });
            } else {
                tagify.settings.whitelist = whitelist;
                tagify.updateSettings();
            }
        }
    });

    mobiscroll.setOptions({
        locale: mobiscroll.localeTh,
        theme: 'windows',
        themeVariant: 'light'
    });

    $(function() {
        var hwInvalids = [{
            recurring: {
                repeat: 'daily',
            },
            resource: ['res4', 'res5', 'res6'],
        }, ];
        var swInvalids = [{
            recurring: {
                repeat: 'daily',
            },
            resource: ['res1', 'res2', 'res3'],
        }, ];
        var hwColors = [{
            recurring: {
                repeat: 'daily',
            },
            resource: ['res1', 'res2', 'res3'],
            background: '#1ad4041a',
        }, ];
        var swColors = [{
            recurring: {
                repeat: 'daily',
            },
            resource: ['res4', 'res5', 'res6'],
            background: '#1ad4041a',
        }, ];

        var $types = $('#meal-type-segmented');
        var $searchList = $('#demo-search-sidebar-list');
        var $calendarTimeline = $('#demo-dynamically-color-and-invalidate');
        var timer;

        var calendar;
        var popup;
        var range;
        var oldShift;
        var tempShift;
        var deleteShift;
        var formatDate = mobiscroll.formatDate;
        var $notes = $('#users-shifts-notes');
        var $deleteButton = $('#users-shifts-delete');

        clearTimeout(timer);
        timer = setTimeout(function() {
            $.getJSON("{{ route('get.meeting.timeline') }}", function(data) {
                var calendar = $calendarTimeline.mobiscroll()
                    .eventcalendar({
                        selectMultipleEvents: true,
                        view: {
                            timeline: {
                                type: 'week',
                            },
                        },
                        invalid: [{
                            start: '12:00',
                            end: '13:00',
                            title: 'Lunch break',
                            recurring: {
                                repeat: 'weekly',
                                weekDays: 'MO,TU,WE,TH,FR',
                            },
                            cssClass: 'md-lunch-break-class mbsc-flex',
                        }],
                        renderResource: function(resource) {
                            return (
                                '<div class="md-meal-planner-cont">' +
                                '<div class="md-meal-planner-title" style="color: #FFF; background: ' + resource.color + '; padding: 10px; border-radius: 3px;">' + resource.name + '</div>' +
                                '</div>'
                            );
                        },
                        resources: data.resources,
                        data: data.data,
                        clickToCreate: true,
                        dragToCreate: false,
                        dragToResize: false,
                        onEventCreate: function(args, inst) {
                            tempShift = args.event;
                            setTimeout(function() {
                                createAddPopup(args);
                            }, 100);
                        },
                        onEventClick: function(args, inst) {
                            oldShift = $.extend({}, args.event);
                            tempShift = args.event;
                            if (!popup.isVisible()) {
                                createEditPopup(args);
                            }
                        },
                    }).mobiscroll('getInst');

                var list = $searchList
                    .mobiscroll()
                    .eventcalendar({
                        view: {
                            agenda: {
                                type: 'year',
                                size: 5,
                            },
                        },
                        showControls: false,
                        onEventClick: function(args) {
                            calendar.navigate(args.event.start);
                            calendar.setSelectedEvents([args.event]);
                        },
                    }).mobiscroll('getInst');
                $searchList.hide();

                $('#md-search-sidebar-demo-input').on('input', function(ev) {
                    var text = ev.target.value;
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        if (text.length > 0) {
                            $.getJSON("{{ route('get.meeting.timeline') }}",
                                function(data) {
                                    list.setEvents(data.data);
                                    $searchList.show();
                                },
                                'jsonp',
                            );
                        } else {
                            $searchList.hide();
                        }
                    }, 200);
                });

                popup = $('#demo-users-shifts-popup')
                    .mobiscroll()
                    .popup({
                        display: 'bottom',
                        contentPadding: false,
                        fullScreen: true,
                        onClose: function() {
                            if (deleteShift) {
                                calendar.removeEvent(tempShift);
                            } else if (restoreShift) {
                                calendar.updateEvent(oldShift);
                            }
                        },
                        responsive: {
                            medium: {
                                display: 'center',
                                width: 400,
                                fullScreen: false,
                                touchUi: false,
                                showOverlay: false,
                            },
                        },
                    })
                    .mobiscroll('getInst');


                // =============================CreateAddPopup============================= //
                function createAddPopup(args) {
                    $deleteButton.hide();
                    deleteShift = true;
                    restoreShift = false;

                    popup.setOptions({
                        headerText: '<div> Create Meeting Rooms </div><div class="users-shifts-day">' +
                            formatDate('DDDD', new Date(tempShift.start)) + ',' +
                            formatDate('DD MMMM YYYY', new Date(tempShift.start)) +
                            '</div>',
                        buttons: [
                            'cancel',
                            {
                                text: 'Add',
                                keyCode: 'enter',
                                handler: function() {
                                    console.log(tempShift);
                                    calendar.updateEvent(tempShift);
                                    deleteShift = false;
                                    popup.close();
                                },
                                cssClass: 'mbsc-popup-button-primary',
                            },
                        ],
                    });
                    popup.open();
                }

                // =============================CreateEditPopup============================= //
                function createEditPopup(args) {
                    var ev = args.event;
                    var headerText =
                        '<div>Edit ' + args.event.title +
                        '\'s hours</div><div class="users-shifts-day">' +
                        formatDate('DDDD', new Date(ev.start)) + ',' +
                        formatDate('DD MMMM YYYY', new Date(ev.start)) +
                        '</div>';

                    $deleteButton.show();

                    deleteShift = false;
                    restoreShift = true;

                    popup.setOptions({
                        headerText: headerText,
                        buttons: [
                            'cancel',
                            {
                                text: 'Save',
                                keyCode: 'enter',
                                handler: function() {
                                    var date = range.getVal();
                                    calendar.updateEvent({
                                        id: ev.id,
                                        title: formatDate('HH:mm', date[0]) + ' - ' + formatDate('HH:mm', date[1] ? date[1] : date[0]),
                                        notes: $notes.val(),
                                        start: date[0],
                                        end: date[1] ? date[1] : date[0],
                                        resource: resource.id,
                                        color: resource.color,
                                        slot: slot.id,
                                    });

                                    restoreShift = false;
                                    popup.close();
                                },
                                cssClass: 'mbsc-popup-button-primary',
                            },
                        ],
                    });

                    $notes.mobiscroll('getInst').value = ev.notes || '';
                    range.setOptions({
                        minTime: ev.slot == 1 ? '07:00' : '12:00',
                        maxTime: ev.slot == 1 ? '13:00' : '18:00'
                    });
                    range.setVal([ev.start, ev.end]);

                    popup.open();
                }


                // =============================CreateEditPopup============================= //
                range = $('#demo-users-shifts-date')
                    .mobiscroll()
                    .datepicker({
                        controls: ['time'],
                        select: 'range',
                        display: 'anchored',
                        showRangeLabels: false,
                        touchUi: false,
                        startInput: '#users-shifts-start',
                        endInput: '#users-shifts-end',
                        stepMinute: 30,
                        timeWheels: '|h:mm A|',
                        onChange: function(args) {
                            var date = args.value;
                            tempShift.start = date[0];
                            tempShift.end = date[1] ? date[1] : date[0];
                            tempShift.title = formatDate('HH:mm', date[0]) + ' - ' + formatDate('HH:mm', date[1] ? date[1] : date[0]);
                        },
                    })
                    .mobiscroll('getInst');

            }, 'jsonp', );
        }, 200);

    });
</script>
@endsection