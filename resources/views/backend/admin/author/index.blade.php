@extends('layouts.admin')
@section('title','all-author')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">All Author <span class="badge badge-primary">{{$authors->count()}}</span></h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Posts</th>
                            <th>Total Comments</th>
                            <th> Favorite</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($authors as $key => $author)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$author->name}}</td>
                                {{-- should use scope later --}}
                                <td>{{$author->posts_count}}</td>  
                                <td>{{$author->comments_count}}</td>  
                                <td>{{$author->favorite_to_posts_count}}</td> 
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-trash-can"
                                            onclick="deleteCategory({{$author->id}})"></i></button>
                                    <form id="delete-form-{{$author->id}}" action="{{url('admin/categories/'.$author->id)}}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Posts</th>
                            <th>Total Comments</th>
                            <th> Favorite</th>
                            <th>Action</th>
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
