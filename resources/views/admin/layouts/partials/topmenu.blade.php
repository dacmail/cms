<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-notifications={{ Auth::user()->unreadNotifications->count() }}>
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-default {{ Auth::user()->unreadNotifications->count() ? '' : 'hide' }}"> {{ Auth::user()->unreadNotifications->count() }} </span>
            </a>
            <ul class="dropdown-menu">
{{--                 <li class="external">
                    <h3>
                        <span class="bold">12 pending</span> notifications</h3>
                    <a href="page_user_profile_1.html">view all</a>
                </li> --}}
                <li>
                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                        @if (Auth::user()->notifications->count())
                            @foreach (Auth::user()->notifications as $notification)
                            <li>
                                <a href="{{ $notification->data['link'] }}">
                                    <span class="details">
                                        {{ $notification->data['text'] }}
                                    </span>
                                    <span class="time" style="margin-top: 5px">{{ $notification->created_at->diffForHumans() }}</span>
                                    <span class="clearfix"></span>
                                </a>
                            </li>
                            @endforeach
                        @else
                            <li>
                                <a href="#" class="bg-info">
                                    Aún no has recibido notificaciones.
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </li>
        <!-- END NOTIFICATION DROPDOWN -->
        <!-- BEGIN TODO DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        {{-- <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="fa fa-tasks"></i>
                <span class="badge badge-default"> 3 </span>
            </a>
            <ul class="dropdown-menu extended tasks">
                <li class="external">
                    <h3>You have
                        <span class="bold">12 pending</span> tasks</h3>
                    <a href="app_todo.html">view all</a>
                </li>
                <li>
                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                        <li>
                            <a href="javascript:;">
                                <span class="task">
                                    <span class="desc">New release v1.2 </span>
                                    <span class="percent">30%</span>
                                </span>
                                <span class="progress">
                                    <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">40% Complete</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li> --}}
        <!-- END TODO DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" class="img-circle" src="/assets/images/user-avatar.png" />
                <span class="username username-hide-on-mobile hidden-sm"> {{ Auth::user()->name }} </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="{{ route('admin::panel::users::edit', ['id' => Auth::user()->id]) }}">
                        <i class="fa fa-user"></i> Mi perfil
                    </a>
                </li>
                <li>
                    <a href="{{ route('auth::logout') }}" class="logout-button">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
    </ul>
</div>
<!-- END TOP NAVIGATION MENU
