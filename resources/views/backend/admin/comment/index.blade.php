@extends('layouts.admin')
@section('title','all-comment ')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">All Comment </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th class="text-center">Comment Info</th>
                                <th class="text-center">Post Info</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($comments as $key=>$comment)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img style="height:64px; width:64px;" class="media-object"
                                                    src="{{asset('storage/profile/'.$comment->user->image)}}"
                                                    alt="Profile">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading d-inline me-10">{{$comment->user->name}}</h4>
                                                <small>{{$comment->created_at->diffForHumans()}}</small>
                                                <p class="mb-10 pt-3">{{$comment->comment}}</p>
                                                <a target="_blank" class="text-primary"
                                                    href="{{url('post/'.$comment->post->slug)}}">Reply</a>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img style="height:64px; width:64px;" class="media-object"
                                                    src="{{asset('storage/profile/'.$comment->post->user->image)}}"
                                                    alt="Profile">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                                <a target="_blank" href="{{url('post/'.$comment->post->slug)}}">
                                                    <h4 class="media-heading">{{Str::limit($comment->post->title,'40')}}
                                                    </h4>
                                                </a>
                                            <p>by <strong>{{$comment->post->user->name}}</strong></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-trash-can" onclick="deleteComment({{$comment->id}})"></i></button>
                                    <form id="delete-form-{{$comment->id}}"
                                        action="{{url('admin/comments/destroy/'.$comment->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#ID</th>
                                <th class="text-center">Comment Info</th>
                                <th class="text-center">Post Info</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{asset('admin')}}/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="{{asset('admin')}}/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('admin')}}/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
    function deleteComment(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
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
