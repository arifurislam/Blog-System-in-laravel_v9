@extends('layouts.admin')
@section('title','subscribers')
@push('css')
<link href="{{asset('admin')}}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('contents')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">All Subscriber <span class="badge badge-primary">{{$subscribers->count()}}</span></h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Email Address</th>
                                <th>Time & Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscribers as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->created_at->format(' h : i : a || d - M - Y')}}</td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-trash-can" onclick="deleteSubscriber({{$data->id}})"></i></button>
                                    <form id="delete-form-{{$data->id}}"
                                        action="{{url('admin/subscribers/delete/'.$data->id)}}" method="post">
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
                                <th>Email Address</th>
                                <th>Time & Date</th>
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
    function deleteSubscriber(id) {
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
