@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">All Banners</h4>
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
                            <a href="{{ route('banner.index') }}">All Banners</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">All Banners <span class="badge badge-success">{{\App\Models\Banner::count()}}</span></h4>

                                    <a href="{{route('banner.create')}}" class="btn btn-primary btn-round ml-auto">New Banner</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover" >
                                        <thead>
                                        <tr>
                                            <th width="20%">Title</th>
                                            <th width="40%">Description</th>
                                            <th>Image</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($banners as $item)
                                            <tr>
                                                <td>{{ $item->title}}</td>
                                                <td>{!!html_entity_decode($item->description)!!}</td>
                                                <td><img  src="{{$item->photo}}" alt="banner-img" style="max-height: 90px; max-width: 120px;"></td>
                                                @if($item->condition == 'banner')
                                                    <td><div class="badge badge-primary badge-shadow">Banner</div></td>
                                                @elseif($item->condition == 'promo')
                                                    <td><div class="badge badge-danger badge-shadow">Promo</div></td>
                                                @endif

                                                <td>
                                                    <input type="checkbox" name="toogle" data-toggle="toggle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked' : ''}} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                                                </td>

                                                <td>
                                                    <a href="{{ route('banner.edit', $item->id) }}" title="edit" class="btn btn-sm btn-outline-info float-left"> <i class="fas fa-edit"></i></a>
                                                    <form class="float-left ml-2" action="{{ route('banner.destroy', $item->id) }}" method="post">
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
                text: "Once deleted, you will not be able to recover the banner!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Banner Deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Banner is Safe!");
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
                url:"{{ route('banner.status') }}",
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
