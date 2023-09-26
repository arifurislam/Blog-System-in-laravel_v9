@extends('layouts.website')
@push('css')
<link href="{{asset('frontend')}}/front-page-category/css/styles.css" rel="stylesheet">
<link href="{{asset('frontend')}}/front-page-category/css/responsive.css" rel="stylesheet">
@endpush

@section('title', 'Wellcome')
@section('content')

<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true">
        <div class="swiper-wrapper">
            @foreach ($categories as $category)
            <div class="swiper-slide">
                <a class="slider-category" href="{{url('post/category/'.$category->slug)}}">
                    <div class="blog-image"><img src="{{asset('storage/category/'.$category->image)}}" alt="Blog Image">
                    </div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>{{$category->name}}</b></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-image"><img src="{{asset('storage/post/'.$post->image)}}" alt="Blog Image">
                        </div>
                        <a class="avatar" href="{{url('profile/'.$post->user->username)}}"><img
                                src="{{asset('storage/profile/avatar.png')}}" alt="Profile Image"></a>
                        <div class="blog-info">
                            <h4 class="title"><a href="{{url('post/'.$post->slug)}}"><b>{{$post->title}}</b></a></h4>
                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript::void(0);" onclick="warningSweetAlert()"><i
                                            class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>
                                    @else
                                    <a class="{{Auth::user()->favorite_to_posts->
                                        where('pivot.post_id',$post->id)->count() == 0 ? '':'favorite'}}"
                                        href="javascript::void(0);"
                                        onclick="document.getElementById('favorite-form-{{$post->id}}').submit()"><i
                                            class="ion-heart"></i>{{$post->favorite_to_users->count()}} </a>
                                    <form id="favorite-form-{{$post->id}}" class="d-none" method="post"
                                        action="{{url('favorite/'.$post->id.'/add')}}">
                                        @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i> {{$post->comments->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    function warningSweetAlert() {
        swal("You Need To Log In", "To add favorite list you need to log in first");
    }
</script>
@endpush
