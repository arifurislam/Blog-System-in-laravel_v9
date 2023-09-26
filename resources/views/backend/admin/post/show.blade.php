@extends('layouts.admin')
@section('title','details-post')
@push('css')
@endpush
@section('contents')
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="d-flex justify-content-between">
            <a href="{{url('admin/posts')}}" class="btn btn-sm btn-danger">
                <i class="fa-solid fa-arrow-left pr-2"></i>
                Posts</a>
            <div>
                @if($post->Is_approved == 0)
                <button type="submit" class="btn btn-sm btn-primary"
                    onclick="approvePost({{$post->id}})">Approve</button>
                <form id="approved-form-{{$post->id}}" action="{{url('admin/panding/posts/approved/'.$post->id)}}"
                    method="post">
                    @csrf
                    @method('put')
                </form>
                @else
                <button class="btn btn-sm btn-primary" disabled>Approved</button>
                @endif
            </div>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card rounded-0">
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{$post->title}}</h5>
                        <p class="pb-4 border-bottom">Posted by {{$post->user->name}} on
                            {{$post->created_at->format('d  M , Y')}}
                        </p>
                        <div>
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card rounded-0">
                    <div class="card-header bg-primary border-bottom">
                        <h5 class="text-white">Related Categories</h5>
                    </div>
                    <div class="card-body">
                        @foreach($post->categories as $postCategory)
                        <span class="badge badge-sm badge-primary">{{$postCategory->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card rounded-0 mb-4">
                    <div class="card-header bg-success border-bottom">
                        <h5 class="text-white">Related Brands</h5>
                    </div>
                    <div class="card-body">
                        @foreach($post->tags as $postTag)
                        <span class="badge badge-sm badge-primary">{{$postTag->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card rounded-0">
                    <div class="card-header bg-danger border-bottom">
                        <h5 class="text-white">Related Image</h5>
                    </div>
                    <div class="card-body p-40">
                        <img src="{{asset('storage/post/'.$post->image)}}" alt="" height="150px">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    function approvePost(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Want to approve the post from author",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approved-form-' + id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }

</script>
@endpush
@endsection
