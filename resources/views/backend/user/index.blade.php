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
                                            <th width="15%">Action</th>
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
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#userID{{ $item->id }}" title="view" class="btn btn-xs btn-outline-secondary"> <i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('user.edit', $item->id) }}" title="edit" class="btn btn-xs btn-outline-info float-left"> <i class="fas fa-edit"></i></a>
                                                    <form class="float-left" action="{{ route('user.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" title="delete" data-id="{{ $item->id }}"class="dltBtn btn btn-xs btn-outline-danger"> <i class="fas fa-trash"></i></a>
                                                    </form>
                                                </td>

                                                    <div class="modal fade" id="userID{{ $item->id }}" tabindex="-1" role="dialog" aria-labelled="Modal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            @php
                                                                $user=\App\Models\User::where('id', $item->id)->first();
                                                            @endphp
                                                            <div class="modal-content">
                                                                <div class="text-center">
                                                                    <img src="{{ $user->photo }}" style="border-radius: 50%; margin: 5% 0;" alt="User-IMG">
                                                                </div>
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="ModalTitle">{{ \Illuminate\Support\Str::upper($user->full_name) }}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <strong>Username:</strong>
                                                                            <p>{{ $user->username }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Email:</strong>
                                                                            <p>{{ $user->email }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Phone:</strong>
                                                                            <p>{{ $user->phone }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Address:</strong>
                                                                            <p>{{ $user->address }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Role:</strong>
                                                                            <p>{{ $user->role }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Status:</strong>
                                                                            <button class="btn btn-sm btn-warning disabled btn-border">{{ $user->status }}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    {{-- <button type="button" class="btn btn-primary">Save Changes</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
