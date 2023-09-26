@extends('layouts.website')

@push('css')
<link href="{{asset('frontend')}}/single-post-1/css/styles.css" rel="stylesheet">
<link href="{{asset('frontend')}}/single-post-1/css/responsive.css" rel="stylesheet">
<style>
    .favorite {
        color: #498BF9 !important;
    }

</style>
@endpush

@section('title',)
{{$post->slug}}
@endsection


@section('content')
<section class="post-area section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 no-right-padding">
                <div class="main-post">
                    <div class="blog-post-inner">
                        <div class="post-info">
                            <div class="left-area">
                                <a class="" href="#"><img src="{{asset('storage/profile/'.$post->user->image)}}"
                                        alt="Profile Image"></a>
                            </div>
                            <div class="middle-area">
                                <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                <h6 class="date">on {{$post->created_at->diffForHumans()}}</h6>
                            </div>
                        </div>
                        <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>
                        <p class="para">
                            {!! $post->body !!}
                        </p>
                        <ul class="tags">
                            @foreach($post->tags as $tag)
                            <li><a href="{{url('post/tag/'.$tag->slug)}}">{{$tag->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="post-icons-area">
                        <ul class="post-icons">
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
                            <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 no-left-padding">
                <div class="single-post info-area">
                    <div class="sidebar-area about-area">
                        <img src="{{asset('storage/post/'.$post->image)}}" alt="">
                    </div>
                    <div class="tag-area">
                        <h4 class="title"><b>Categories</b></h4>
                        <ul>
                            @foreach($post->categories as $category)
                            <li><a href="{{url('post/category/'.$category->slug)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="recomended-area section">
    <div class="container">
        <div class="row">
            @foreach($randomposts as $randompost)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{asset('storage/post/'.$randompost->image)}}"
                                alt="Blog Image"></div>

                        <a class="avatar" href="#"><img src="{{asset('storage/profile/'.$randompost->user->image)}}"
                                alt="Profile Image"></a>

                        <div class="blog-info">

                            <h4 class="title"><a
                                    href="{{url('post/'.$randompost->slug)}}"><b>{{$randompost->title}}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript::void(0);" onclick="warningSweetAlert()"><i
                                            class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>
                                    @else
                                    <a class="{{Auth::user()->favorite_to_posts->
											where('pivot.post_id',$randompost->id)->count() == 0 ? '':'favorite'}}" href="javascript::void(0);"
                                        onclick="document.getElementById('favorite-form-{{$randompost->id}}').submit()"><i
                                            class="ion-heart"></i>{{$randompost->favorite_to_users->count()}} </a>
                                    <form id="favorite-form-{{$randompost->id}}" class="d-none" method="post"
                                        action="{{url('favorite/'.$randompost->id.'/add')}}">
                                        @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>{{$randompost->comments->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$randompost->view_count}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="comment-section">
    <div class="container">
        <h4><b>Post Your Comments 0</b></h4>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest
                    <p> To comment is this post , you need to "login" first
                        <a style="color:#498BF9;" href="{{route('login')}}">Log in here</a>
                    </p>
                    @else
                    <form method="post" action="{{url('comments/'.$post->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea name="comment" rows="2" class="text-area-messge form-control"
                                    placeholder="Enter your comment" aria-required="true"
                                    aria-invalid="false"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </div>

                        </div>
                    </form>
                    @if ($errors->has('comment'))
                    <span class="invalid-feedback mt-3" role="alert">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </span>
                    @endif
                    @endguest
                </div>
                <h4><b>COMMENTS ({{$post->comments->count()}})</b></h4>
                @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="post-info">
                        <div class="left-area">
                            <a class="avatar" href="#"><img src="{{asset('storage/profile/'.$post->user->image)}}"
                                    alt="Profile Image"></a>
                        </div>
                        <div class="middle-area ml-20">
                            <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                            <h6 class="date"><b>on </b>{{$comment->created_at->diffForHumans()}}</h6>
                        </div>
                    </div>
                    <p class="ml-50">{{$comment->comment}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>

@endsection
@push('js')
{{-- <script>
    var replyContent = document.getElementById("reply");
    replyContent.style.display = "none";

    function reply() {
        replyContent.style.display = "block";
    }

</script> --}}
@endpush
