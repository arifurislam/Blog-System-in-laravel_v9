@extends('layouts.admin')
@section('title','all-post')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">All Post <div class="badge badge-primary">{{$posts->count()}}</div></h4>
                    <a href="{{url('admin/posts/create')}}" class="btn btn-sm btn-primary"><i
                            class="icon-plus pr-2"></i>Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>View</th>
                                <th>Status</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{Str::limit($data->title,15)}}</td>
                                <td>{{Str::limit($data->user->name,14)}}</td>
                                <td>{{$data->view_count}}</td>
                                <td>
                                    @if($data->status == 1)
                                        <span class="badge badge-primary">Published</span>
                                    @else
                                        <span class="badge badge-info">Unpublished</span>
                                    @endif
                                </td>
                                <td>{{$data->created_at->format('d - M - Y')}}</td>
                                <td>
                                    <a href="{{url('admin/posts/'.$data->id)}}" class="btn btn-sm btn-primary" disabled><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{url('admin/posts/'.$data->id.'/edit')}}" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-trash-can" onclick="deleteCategory({{$data->id}})"></i></button>
                                    <form id="delete-form-{{$data->id}}"
                                        action="{{url('admin/posts/'.$data->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#SL</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>View</th>
                                <th>Status</th>
                                <th>Created_at</th>
                                <th>Action</th>
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
    function deleteCategory(id) {
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
