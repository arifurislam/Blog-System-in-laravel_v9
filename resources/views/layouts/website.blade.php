<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website')</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="{{asset('frontend')}}/common-css/bootstrap.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/common-css/swiper.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/common-css/ionicons.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/common-css/custom.css" rel="stylesheet">
	<script src="{{asset('frontend')}}/common-js/jquery-3.1.1.min.js"></script>
    <script src="{{asset('frontend')}}/common-js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    {{-- <link rel="stylesheet" href="{{asset('frontend')}}/css/styles.css"> --}}
    @stack('css')
</head>

<body>

    <header>
        <div class="container-fluid position-relative no-side-padding">

            <a href="{{url('/')}}" class="logo"><img src="{{asset('frontend')}}/images/logo.png" alt="Logo Image"></a>

            <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

            <ul class="main-menu visible-on-click" id="main-menu">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('posts')}}">Posts</a></li>
                @guest
                <li><a href="{{url('/login')}}">Log In</a></li>
                @else
                @if(Auth::user()->role->id == 1)
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                @endif
                @if(Auth::user()->role->id == 2)
                <li><a href="{{url('author/dashboard')}}">Dashboard</a></li>
                @endif
                @endguest
            </ul>
            <div class="src-area">
                <form method="get" action="{{url('/posts/search')}}">
                    <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    <input class="src-input" value="{{isset($query) ? $query:''}}" name="search" type="text"
                        placeholder="Type of search">
                </form>
            </div>
        </div>
    </header>
    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <a class="logo" href="{{url('/')}}"><img src="{{asset('frontend')}}/images/logo.png"
                                alt="Logo Image"></a>
                        <p class="copyright">Bona @ 2023. All rights reserved.</p>
                        <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                        <ul class="icons">
                            <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <h4 class="title">Categories</h4>
                        <ul>
                           @foreach($categories as $category)
                           <li><a href="{{url('post/category/'.$category->slug)}}">{{$category->name}}</a></li>
                           @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        @if(Session::has('success'))
                        <script>
                            swal({
                                title: "Success!",
                                text: "Successfully Subscribed.",
                                timer: 5000,
                                icon: "success",
                            });

                        </script>
                        @endif

                        @if(Session::has('error'))
                        <script>
                            swal({
                                title: "Opps!",
                                text: "Subscribtion failed.",
                                timer: 5000,
                                icon: "warning",
                            });

                        </script>
                        @endif
                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form method="post" action="{{url('/subscribers/store')}}">
                                @csrf
                                <input class="email-input {{$errors->has('email')? 'has-error':''}}" name="email"
                                    type="email" placeholder="Enter your email">
                                <button class="submit-btn" type="submit"><i
                                        class="icon ion-ios-email-outline"></i></button>
                            </form>
                        </div>
						@if ($errors->has('email'))
                            <span class="invalid-feedback mt-3" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('frontend')}}/common-js/tether.min.js"></script>
    <script src="{{asset('frontend')}}/common-js/bootstrap.js"></script>
    <script src="{{asset('frontend')}}/common-js/swiper.js"></script>
    <script src="{{asset('frontend')}}/common-js/scripts.js"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @stack('js')
</body>

</html>
