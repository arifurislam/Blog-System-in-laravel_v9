@extends('layouts.admin')
@section('title','edit-tag')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit New Tag</h4>
                    <div class="basic-form">
                        <form method="post" action="{{url('/admin/tags/'.$tag->id)}}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Tag Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{$tag->name}}" name="name" id="name"
                                    class="form-control input-default {{$errors->has('name')? 'has-error':''}}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback mb-0" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <a href="{{url('/admin/tags')}}" class="btn btn-danger"><i
                                    class="fa-solid fa-arrow-left pr-2"></i>Back</a>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fa-solid fa-upload fa-beat pr-2"></i>Update Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush
@endsection
