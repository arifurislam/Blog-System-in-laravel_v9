@extends('layouts.admin')
@section('title','details-post')
@push('css')
@endpush
@section('contents')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Post Details</h4>
                    <a href="{{url('admin/posts')}}" class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-arrow-left pr-2"></i>
                        Posts</a>
                </div>
                <table class="table table-striped table-bordered view_table_custom">
                    <tr>
                        <td>Title</td>
                        <td>:</td>
                        <td>{{$post->title}}</td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>:</td>
                        <td>{{$post->user->name}}</td>
                    </tr>
                    <tr>
                        <td>View</td>
                        <td>:</td>
                        <td>{{$post->count}}</td>
                    </tr>
                    <tr>
                        <td>Approved</td>
                        <td>:</td>
                        <td>
                            @if($post->Is_approved == 1)
                            <span class="badge badge-primary">Published</span>
                            @else
                            <span class="badge badge-info">Unpublished</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if($post->status == 1)
                            <span class="badge badge-primary">Published</span>
                            @else
                            <span class="badge badge-info">Unpublished</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Created_at</td>
                        <td>:</td>
                        <td>{{$post->created_at->format('g:i  A  ||  D - M - Y')}}</td>
                    </tr>
                    <tr>
                        <td>Updated_at</td>
                        <td>:</td>
                        <td>{{$post->updated_at->format('g:i  A  ||  D - M - Y')}}</td>
                    </tr>
                    <tr>
                        <td>Post Image</td>
                        <td>:</td>
                        <td>
                            <img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->id}}" height="200px">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')

@endpush
@endsection
