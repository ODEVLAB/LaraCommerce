@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">All Brands</h4>
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
                            <a href="{{ route('brand.index') }}">All Brands</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">All Brands <span class="badge badge-success">{{\App\Models\Brand::count()}}</span></h4>

                                    <a href="{{route('brand.create')}}" class="btn btn-primary btn-round ml-auto">New Brand</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover" >
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($brands as $item)
                                            <tr>
                                                <td>{{ $item->title}}</td>
                                                <td>{{ $item->slug}}</td>
                                                <td><img  src="{{$item->photo}}" alt="banner-img" style="max-height: 90px; max-width: 120px;"></td>

                                                <td>
                                                    <input type="checkbox" name="toogle" data-toggle="toggle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked' : ''}} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                                                </td>

                                                <td>
                                                    <a href="{{ route('brand.edit', $item->id) }}" title="edit" class="btn btn-sm btn-outline-info float-left"> <i class="fas fa-edit"></i></a>
                                                    <form class="float-left" action="{{ route('brand.destroy', $item->id) }}" method="post">
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
{{--            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
            <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
            <script type="text/javascript">
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
                        text: "Once deleted, you will not be able to recover the Brand!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                                swal("Poof! Brand Deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Brand is Safe!");
                            }
                        });
                });
            </script>

            <script type="text/javascript">
                $('input[name=toogle]').change(function() {
                    var mode=$(this).prop('checked');
                    var id=$(this).val();
                    // alert(mode);
                    $.ajax({
                        url:"{{ route('brand.status') }}",
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
