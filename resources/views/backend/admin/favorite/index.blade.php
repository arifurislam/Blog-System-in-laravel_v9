@extends('layouts.admin')
@section('title','favorite-posts')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">All Favorite Post <span class="badge badge-primary">{{$favoritePost->count()}}</span></h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th><i class="fa-regular fa-heart"></i></th>
                                <th><i class="fa-solid fa-eye"></i></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($favoritePost as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{Str::limit($data->title , 15)}}</td>
                                <td>{{$data->user->name}}</td>
                                <td>{{$data->favorite_to_users->count()}}</td>
                                <td>{{$data->count}}</td>
                                <td>
                                    {{-- <a href="" class="btn btn-sm btn-primary" disabled><i class="fa-solid fa-eye"></i></a> --}}
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-trash-can" onclick="removeFavorite({{$data->id}})"></i></button>
                                    <form id="delete-form-{{$data->id}}"
                                        action="{{url('favorite/'.$data->id.'/add')}}" method="post">
                                        @csrf
                                        @method('post')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th><i class="fa-regular fa-heart"></i></th>
                                <th><i class="fa-solid fa-eye"></i></th>
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
    function removeFavorite(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Want to remove from favorite list",
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
