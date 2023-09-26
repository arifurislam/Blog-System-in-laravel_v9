@extends('layouts.author')
@section('title','home')
@push('css')

@endpush
@section('contents')
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-1">
            <div class="card-body">
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
            <div class="card-body">
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
            <div class="card-body">
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
            <div class="card-body">
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Most Popular 5 post</h4>
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th># Rank List</th>
                                    <th>Titile</th>
                                    <th>Views</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               @foreach($popular_posts as $key=> $posts)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ Str::limit($posts->title,40)}}</td>
                                    <td>{{ $posts->view_count}}</td>
                                    <td>{{ $posts->favorite_to_users_count}}</td>
                                    <td>{{ $posts->comments_count}}</td>
                                    <td>
                                        @if($posts->status == 1)
                                            <span class="badge badge-primary">Publish</span>
                                        @else 
                                            <span class="badge badge-warning">Unpublish</span>
                                        @endif
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


@push('js')

@endpush
@endsection
