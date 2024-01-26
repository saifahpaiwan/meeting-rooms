<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle waves-effect waves-light" id="click-notification" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
        <i class="dripicons-bell noti-icon"></i>
        @if(helperCountNoti()>0)
        <span class="badge badge-pink rounded-circle noti-icon-badge">{{ helperCountNoti() }}</span> 
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

        <div class="dropdown-header noti-title">
            <h5 class="text-overflow m-0"> 
                Notification
            </h5>
        </div>

        <div class="slimscroll noti-scroll" id="list-notification">
  
        </div>

        <!-- All-->
        <a href="{{ route('notifications.index') }}" class="dropdown-item text-center text-primary notify-item notify-all">
            View all
            <i class="fi-arrow-right"></i>
        </a>

    </div>
</li>