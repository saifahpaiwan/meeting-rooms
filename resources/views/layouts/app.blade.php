<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Project Name') }}</title>

    <!-- shortcut icon -->
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

    <!-- App css -->
    <link href="{{ asset('template/css/root-color.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ asset('template/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="{{ asset('template/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        a {
            text-decoration: inherit !important;
        }

        .page-title-box {
            padding: 12px 20px;
        }

        .drinkcard-cc {
            color: #fff;
            padding: 0.25rem;
            border-radius: 5px;
        }

        .note-popover .popover-content,
        .card-header.note-toolbar {
            z-index: 2;
        }

        .w-220 {
            width: 220px;
        }

        .notification-list .notify-item .notify-icon {
            height: 50px;
            width: 50px;
            line-height: 50px;
        }

        .select2-container--default .select2-selection--single {
            height: 35.6px;
            border: 1px solid #dee2e6;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35.6px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35.6px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: var(--primary-main);
            border: 1px solid #072f76;
        }

        .box-image-no {
            width: 185px;
            height: 105px;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
        }

        .w-30 {
            width: 30% !important;
        }

        .flex-icon-noti {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .noti-scroll {
            height: 200px !important;
        }

        .stepy-header li div:after {
            font-family: "Material Design Icons";
        }

        .text-sort {
            color: #d4d4d4;
        }

        .plant-title {
            background: #ff0909;
            color: #fff;
            padding: 0 1rem;
            border-radius: 0.2rem;
        }

        th,
        td {
            white-space: nowrap;
        }

        .box-image-no {
            background: #ddd;
            border-radius: 0.25rem;
            width: 100px;
            height: 100px;
        }

        .position-alert {
            position: fixed;
            z-index: 999;
            right: 1rem;
            top: 1rem;
            box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
            opacity: 0.9;
        }

        .alert-icon-size {
            font-size: 20px;
        }

        .alert-dismissible .close {
            background: #000;
            color: #FFF;
            opacity: 0.7;
            top: -10px;
            right: -10px;
            padding: 0;
            width: 30px;
            height: 30px;
            border-radius: 1rem;
            font-weight: 400;
        }

        .close:hover {
            color: #dbdbdb;
        }

        @media (max-width: 767.98px) {
            .responsive-mobile-btn {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .responsive-mobile-title {
                display: none;
            }

            .responsive-mobile-badge {
                width: 100%;
            }

            .dropdown-lg {
                width: 250px !important;
            }
        }
    </style>
    @yield('style')
</head>

<body>

    <div id="wrapper">
        <div class="navbar-custom">
            @guest
            @else
            <ul class="list-unstyled topnav-menu float-right mb-0 d-flex align-items-center">
                @include('include.notification')
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light d-flex justify-content-center align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        @if(isset(Auth::user()->images_name) && !empty(Auth::user()->images_name))
                        <div class="rounded-circle" style="background: url(<?php echo asset('/images/users') . '/' . auth()->user()->images_name; ?>); 
                        width: 32px; height: 32px;background-size: cover; background-position: center;"> </div>
                        @endif
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->username }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0"> ยินดีต้อนรับเข้าสู่ระบบ </h6>
                        </div>

                        @can('user-edit')
                        <a href="{{ route('users.edit', [Auth::user()->id, 'rd=1']) }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>ตั้งค่าข้อมูลส่วนตัว</span>
                        </a>
                        @endcan

                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            {{ Auth::user()->getRoleNames()->first() }}
                        </a>
                        <a href="#" class="dropdown-item notify-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fe-log-out"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            @endguest

            <div class="logo-box">
                <a href="{{ route('home') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{ asset('/favicon.ico') }}" height="30" style="border-radius: 0.2rem;">
                        <small class="ml-2 text-white">{{ config('app.name', 'Project Name') }}</small>
                    </span>
                    <span class="logo-sm">
                        <img class="rounded-circle" src="{{ asset('/favicon.ico') }}" width="35" height="35">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>
            </ul>
        </div>

        <div class="left-side-menu">
            <div class="slimscroll-menu">
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title"> Menu List </li>
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fe-calendar"></i>
                                <span> ปฏิทิน Timeline Booking </span>
                            </a>
                        </li>
                        @can('meeting-rooms-list')
                        <li>
                            <a href="{{ route('meeting-rooms.index') }}">
                                <i class="fe-box"></i>
                                <span> ข้อมูลห้องประชุม </span>
                            </a>
                        </li> 
                        @endcan
                        @can('meetings-list')
                        <li>
                            <a href="{{ route('meetings.index') }}">
                                <i class="fe-users"></i>
                                <span> จัดการประชุม </span>
                            </a>
                        </li> 
                        @endcan 

                        @can('user-list')
                        <li class="menu-title"> Management Authenticate </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fe-settings"></i>
                                <span> การตั้งค่าระบบ </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @can('user-list')
                                <li>
                                    <a href="{{ route('users.index') }}">
                                        <span> ผู้ใช้งานระบบ </span>
                                    </a>
                                </li>
                                @endcan
                                @can('role-list')
                                <li>
                                    <a href="{{ route('roles.index') }}">
                                        <span> กำหนดสิทธิ์ </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('log-viewer') }}">
                                        <span> Logs System </span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="content-page">
            <div class="content">

                <div>
                    @include('include.alert-success')
                    @include('include.alert-danger')
                    @include('include.alert-info')
                </div>

                @yield('content')
            </div>
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12">
                        {{ date('Y')}} &copy; {{ config('app.name', 'Project Name') }}
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <script src="{{ asset('template/js/vendor.min.js') }}"></script>
    <script src="{{ asset('template/js/app.min.js') }}"></script>
    <script src="{{ asset('template/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('template/libs/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("form").submit(function() {
                $(this).find(":submit").attr('disabled', 'disabled');
                $(this).find(":submit").html('<i class="mdi mdi-spin mdi-loading"></i>');
            });

            $(".delete-confirm").click(function() {
                if (!confirm("ยืนยันการลบข้อมูลหรือไม : การลบข้อมูลจะไม่สามารถนำข้อมูลกลับได้ !")) {
                    return false;
                }
            });
        });

        // ปุ่มย้อนกลับ
        function back() {
            window.history.back();
        }

        // ปุ่มย้อนไป
        function go() {
            window.history.go(-1);
        }

        $(document).on('click', '.page-link', function(event) {
            locationSearch = location.search;
            let params = new URLSearchParams(locationSearch);
            let page = params.get('page');
            if (locationSearch.substring(1)) {
                var substring = locationSearch.substring(1);
                if (page) {
                    var split = substring.split("page=" + page);
                    window.location.href = $(this)[0].href + split[1];
                } else {
                    window.location.href = $(this)[0].href + '&' + locationSearch.substring(1);
                }
            } else {
                window.location.href = $(this)[0].href;
            }
            return false;
        });

        $(document).on('click', '#click-notification', function(event) {
            html = "";
            html += '<li class="noti"> <div class="text-center"> <i class="fa fa-spin fa-circle-o-notch"></i><br>loading... </div> </li>';
            $('#list-notification').html(html);
            $.get("{{ url('notifications').'/'.auth()->user()->id }}")
                .done(function(data, status, error) {
                    if (error.status == 200) {
                        html = "";
                        for (let key in data) {
                            var color = (data[key].status == "N") ? "#f6f6f6" : "#FFF";
                            html += '<a href="javascript: void(0);" class="dropdown-item notify-item notify-read" data-id="' + data[key].id + '" data-url="' + data[key].url + '" style="background:' + color + ';">';
                            html += '    <div class="notify-icon bg-' + data[key].color + '">';
                            html += '        <li class="' + data[key].icon + ' flex-icon-noti"></li>';
                            html += '    </div>';
                            html += '    <p class="notify-details">' + data[key].message;
                            html += '        <small class="text-muted"> โดย : ' + data[key].sender + '</small>';
                            html += '        <small class="text-muted">' + data[key].created_at + '</small>';
                            html += '    </p>';
                            html += '</a>';
                        }
                        setTimeout(() => {
                            $('#list-notification').html(html);
                        }, "300");
                    }
                })
                .fail(function(xhr, status, error) {
                    alert(error);
                });
        });

        $(document).on('click', '.notify-read', function(event) {
            var id = $(this)[0].dataset.id;
            var url = $(this)[0].dataset.url;
            $.ajax({
                url: "{{ url('notifications') }}" + "/" + id,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response == "success") {
                        window.location.href = url;
                    }
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>