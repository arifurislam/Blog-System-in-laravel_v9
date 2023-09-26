<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-name" content="quixlab" />
    <title>@yield('title','author')</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin')}}/images/favicon.png">
    <link href="{{asset('admin')}}/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('css')
    <link href="{{asset('admin')}}/css/style.css" rel="stylesheet">

</head>

<body>

    <div id="main-wrapper">
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{url('/admin/dashboard')}}">
                    <b class="logo-abbr"><img src="{{asset('admin')}}/images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="{{asset('admin')}}/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="{{asset('admin')}}/images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>

                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1">3</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                                <span>English</span> <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{asset('admin')}}/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li>

                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock
                                                    Screen</span></a>
                                        </li>
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Apps</li>

                    <li>
                        <a href="{{url('/author/dashboard')}}" aria-expanded="false" class="{{Request::is('author/dashboard') ? 'active':''}}">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{url('/author/posts')}}" aria-expanded="false" class="{{Request::is('author/posts/*') ? 'active':''}}">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('author/favorites')}}" aria-expanded="false"
                            class="{{Request::is('author/favorites/*') ? 'active':''}}">
                            <i class="fa-regular fa-heart"></i><span class="nav-text">Favorite</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('author/comments')}}" aria-expanded="false"
                            class="{{Request::is('author/comments/*') ? 'active':''}}">
                            <i class="fa-regular fa-comment"></i><span class="nav-text">Comment</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('author/settings')}}" aria-expanded="false"
                            class="{{Request::is('settings/*') ? 'active':''}}">
                            <i class="fa-solid fa-gear"></i><span class="nav-text">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}" aria-expanded="false" target="_blank">
                            <i class="icon-globe menu-icon"></i><span class="nav-text">Vist Site</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" aria-expanded="false"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            <i class="icon-power menu-icon"></i><span class="nav-text">Logout</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-body">

            <div class="container-fluid mt-3">
                @yield('contents')
            </div>

            <div class="footer">
                <div class="footer-content py-3">
                    <p class="mb-0">Copyright &copy; Developed by
                         <span class="text-primary">arifurislam4@gmail.com</span> 
                        <script>
                            document.write(new Date().getFullYear());
                        </script></p>
                </div>
            </div>
        </div>

        <script src="{{asset('admin')}}/plugins/common/common.min.js"></script>
        <script src="{{asset('admin')}}/js/custom.min.js"></script>
        <script src="{{asset('admin')}}/js/settings.js"></script>
        <script src="{{asset('admin')}}/js/gleek.js"></script>
        <script src="{{asset('admin')}}/js/styleSwitcher.js"></script>
        <script src="{{asset('admin')}}/plugins/chart.js/Chart.bundle.min.js"></script>
        <script src="{{asset('admin')}}/plugins/circle-progress/circle-progress.min.js"></script>
        <script src="{{asset('admin')}}/plugins/d3v3/index.js"></script>
        <script src="{{asset('admin')}}/plugins/topojson/topojson.min.js"></script>
        <script src="{{asset('admin')}}/plugins/datamaps/datamaps.world.min.js"></script>
        <script src="{{asset('admin')}}/plugins/raphael/raphael.min.js"></script>
        <script src="{{asset('admin')}}/plugins/morris/morris.min.js"></script>
        <script src="{{asset('admin')}}/plugins/moment/moment.min.js"></script>
        <script src="{{asset('admin')}}/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
        <script src="{{asset('admin')}}/plugins/chartist/js/chartist.min.js"></script>
        <script src="{{asset('admin')}}/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
        <script src="{{asset('admin')}}/js/dashboard/dashboard-1.js"></script>
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        @stack('js')

</body>

</html>
