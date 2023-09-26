@extends('layouts.admin')
@section('title','create-post')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
@endpush
@section('contents')

<form method="post" action="{{url('admin/posts')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Post</h4>
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="title">Post Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title"
                                class="form-control input-default {{$errors->has('title')? 'has-error':''}}"
                                placeholder="Suitable Post Title">
                            @if ($errors->has('title'))
                            <span class="invalid-feedback mb-0" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-center">
                                <div class="img-left">
                                    <label for="name">Post Image <span class="text-danger">*</span></label>
                                    <input type="file" name="media" id="imageInput"
                                        class="form-control-file {{$errors->has('media')? 'has-error':''}}">
                                    @if ($errors->has('media'))
                                    <span class="invalid-feedback mb-0" role="alert">
                                        <strong>{{ $errors->first('media') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="img-right">
                                    <img id="imagePreview" src="{{asset('storage/category/white_image.png')}}"
                                        alt="image preview" class="mt-3 d-block" height="50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Select Category & Tag</h4>
                    <div class="basic-form">
                        <div class="form-group mb-3">
                            <label>Select Ctegories <span class="text-danger">*</span></label>
                            <select name="categories[]" id="category" multiple>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                            <span class="invalid-feedback mb-0" role="alert">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Tag <span class="text-danger">*</span></label>
                            <select name="tags[]" id="tag" multiple>
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tags'))
                            <span class="invalid-feedback mb-0" role="alert">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                            @endif
                        </div>
                        <a href="{{url('/admin/posts')}}" class="btn btn-sm btn-danger"><i
                                class="fa-solid fa-arrow-left pr-2"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-upload fa-beat pr-2"></i>Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Body</h4>
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Long Description <span class="text-danger">
                                    *</span></label>
                            <textarea name="body" class="my_summerNote form-control h-150"></textarea>
                        </div>
                        @if ($errors->has('body'))
                        <span class="invalid-feedback mb-0" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
<script>
    $(document).ready(function () {
        $(".my_summerNote").summernote();
        $('.dropdown-toggle').dropdown();
    });

</script>
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    imageInput.addEventListener('change', function (event) {
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            const reader = new FileReader();
            reader.onload = function (event) {
                imagePreview.src = event.target.result;
            };
            reader.readAsDataURL(selectedFile);
        }
    });

</script>
<script>
    new MultiSelectTag('tag')
    new MultiSelectTag('category')

</script>
@endpush
@endsection
