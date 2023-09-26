@extends('layouts.admin')
@section('title','home')
@push('css')

@endpush
@section('contents')
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-1">
            <div class="card-body p-10">
                <h3 class="card-title text-white">Total Post</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$posts->count()}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-file"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-2">
            <div class="card-body p-10">
                <h3 class="card-title text-white">Favorite Posts</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{Auth::user()->favorite_to_posts()->count()}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-3">
            <div class="card-body p-10">
                <h3 class="card-title text-white">Pending Posts</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$pending_posts}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-book"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-4">
            <div class="card-body p-10">
                <h3 class="card-title text-white">Viewed Post</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$total_view}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-eye"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card gradient-2">
                    <div class="card-body p-10">
                        <h3 class="card-title text-white">Categories</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$category_count}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="icon-grid menu-icon"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card gradient-1">
                    <div class="card-body p-10">
                        <h3 class="card-title text-white">Total Author</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$author_count}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-regular fa-user"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card gradient-4">
                    <div class="card-body p-10">
                        <h3 class="card-title text-white">Today Author</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$todays_author}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-regular fa-user"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Most Popular 5 Posts</h4>
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Titile</th>
                                    <th>Author</th>
                                    <th>Views</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               @foreach($popular_posts as $key=> $post)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ Str::limit($post->title,20)}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{ $post->view_count}}</td>
                                    <td>{{ $post->favorite_to_users_count}}</td>
                                    <td>{{ $post->comments_count}}</td>
                                    <td>
                                        @if($post->status == 1)
                                            <span class="badge badge-primary">Publish</span>
                                        @else 
                                            <span class="badge badge-warning">Unpublish</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('post/'.$post->slug)}}" class="btn btn-sm btn-primary" target="_blank">view</a>
                                    </td>
                                </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>                        
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Active 5 Authors</h4>
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th># Rank</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               @foreach($active_authors as $key=> $author)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $author->name}}</td>
                                    <td>{{$author->posts_count}}</td>
                                    <td>{{$author->comments_count}}</td>
                                    <td>{{$author->favorite_to_posts_count}}</td>
                                </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>                        
    </div>
</div>


@push('js')

@endpush
@endsection
