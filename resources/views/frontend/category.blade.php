@extends('layouts.website')

@push('css')
<link href="{{asset('frontend')}}/category/styles.css" rel="stylesheet">
<link href="{{asset('frontend')}}/category/responsive.css" rel="stylesheet">

@endpush

@section('title', 'Post by Category')

@section('content')


<div class="slider display-table center-text bg-cover"
    style="background-image: url({{asset('storage/category/'.$category->image)}});">
    <h1 class="title display-table-cell"><b>Post by Category</b></h1>
</div>

<section class="blog-area section">
    <div class="container">
        <div class="row">
            @if($category->posts->count() > 0)
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-image"><img src="{{asset('storage/post/'.$post->image)}}" alt="Blog Image">
                        </div>
                        <a class="avatar" href="{{url('profile/'.$post->user->username)}}"><img
                                src="{{asset('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>
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
                                <li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->count}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-3"></div>
            <div class="col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-info">
                            <h4 class="title">
                                <strong>There is no post :( </strong>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection
@push('js')

@endpush
