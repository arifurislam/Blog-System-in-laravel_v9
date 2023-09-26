@extends('layouts.admin')
@section('title','create-category')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Category</h4>
                    <div class="basic-form">
                        <form method="post" action="{{url('/admin/categories')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                    class="form-control input-default {{$errors->has('name')? 'has-error':''}}"
                                    placeholder="Input Tag Name">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback mb-0" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Category Image <span class="text-danger">*</span></label>
                                <input type="file" name="media" id="imageInput"
                                    class="form-control-file {{$errors->has('media')? 'has-error':''}}">
                                @if ($errors->has('media'))
                                <span class="invalid-feedback mb-0" role="alert">
                                    <strong>{{ $errors->first('media') }}</strong>
                                </span>
                                @endif
                                <img id="imagePreview" src="{{asset('storage/category/white_image.png')}}" alt="image preview" class="mt-3 d-block" height="50px">
                            </div>
                            <a href="{{url('/admin/categories')}}" class="btn btn-danger"><i
                                    class="fa-solid fa-arrow-left pr-2"></i>Back</a>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fa-solid fa-upload fa-beat pr-2"></i>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
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
@endpush
@endsection
