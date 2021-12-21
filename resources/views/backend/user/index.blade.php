@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">All Users</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}">All Users</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">All Users <span class="badge badge-success">{{\App\Models\User::count()}}</span></h4>

                                    <a href="{{route('user.create')}}" class="btn btn-primary btn-round ml-auto">New User</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover" >
                                        <thead>
                                        <tr>
                                            
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $item)
                                            <tr>
                                                <td><img  src="{{$item->photo}}" alt="user-img" style="border-radius: 50%; max-height: 90px; max-width: 120px;"></td>
                                                <td>{{ $item->full_name}}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone}}</td>
                                                <td>{{ $item->address}}</td>
                                                <td>{{ $item->role}}</td>
                                                
                                                <td>
                                                    <input type="checkbox" name="toogle" data-toggle="toggle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked' : ''}} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                                                </td>

                                                <td>
                                                    <a href="{{ route('product.edit', $item->id) }}" title="edit" class="btn btn-xs btn-outline-info"> <i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('user.edit', $item->id) }}" title="edit" class="btn btn-sm btn-outline-info float-left"> <i class="fas fa-edit"></i></a>
                                                    <form class="float-left ml-2" action="{{ route('user.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" title="delete" data-id="{{ $item->id }}"class="dltBtn btn btn-sm btn-outline-danger"> <i class="fas fa-trash"></i></a>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection


@section('scripts')
{{--    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
            <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
            <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e){
            var form = $(this).closest('form');
            var dataID=$(this).data('id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover the User!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! User Profile Deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("User is Safe!");
                    }
                });
        });
    </script>

    <script>
        $('input[name=toogle]').change(function() {
            var mode=$(this).prop('checked');
            var id=$(this).val();
            // alert(mode);
            $.ajax({
                url:"{{ route('user.status') }}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    mode:mode,
                    id:id,
                },
                success:function (response){
                    if(response.status){
                        alert(response.msg);
                    }
                    else{
                        alert('Please Try again');
                    }
                }
            })
        });
    </script>
@endsection
