@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">All Products</h4>
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
                            <a href="{{ route('product.index') }}">All Products</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">All Products <span class="badge badge-success">{{\App\Models\Product::count()}}</span></h4>
                                    <a href="{{route('product.create')}}" class="btn btn-primary btn-round ml-auto">New Product</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="table table-striped table-hover" >
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Summary</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th width="14%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $item)
                                        @php
                                            $photo =  explode(',',$item->photo);
                                        @endphp
                                            <tr>
                                                <td>{{ $item->title}}</td>
                                                <td>{{ $item->slug}}</td>
                                                <td>{!!html_entity_decode($item->summary)!!}</td>
                                                <td><img src="{{$photo[0]}}" alt="banner-img" style="max-height: 90px; max-width: 120px;"></td>

                                                <td>
                                                    <input type="checkbox" name="toogle" data-toggle="toggle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked' : ''}} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                                                </td>

                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#productID{{ $item->id }}" title="view" class="btn btn-xs btn-outline-secondary"> <i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('product.edit', $item->id) }}" title="edit" class="btn btn-xs btn-outline-info"> <i class="fas fa-edit"></i></a>
                                                    <form class="float-left" action="{{ route('product.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" title="delete" data-id="{{ $item->id }}" class="dltBtn btn btn-xs btn-outline-danger"> <i class="fas fa-trash"></i></a>
                                                    </form>
                                                </td>

                                                <div class="modal fade" id="productID{{ $item->id }}" tabindex="-1" role="dialog" aria-labelled="Modal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        @php
                                                            $product=\App\Models\Product::where('id', $item->id)->first();
                                                        @endphp
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="ModalTitle">{{ $product->title }}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <strong>Summary:</strong><br>
                                                                <p>{!! html_entity_decode($product->summary) !!}</p>
                                                                <strong>Description:</strong><br>
                                                                <p>{!! html_entity_decode($product->description) !!}</p>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <strong>Price:</strong>
                                                                        <p>${{ number_format($product->price, 2) }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Discount:</strong>
                                                                        <p>{{ $product->discount }}%</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Offer Price:</strong>
                                                                        <p>${{ number_format($product->offer_price, 2) }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Category:</strong>
                                                                        <p>{{\App\Models\Category::where('id', $product->cat_id)->value('title') }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Child Category:</strong>
                                                                        <p>{{\App\Models\Category::where('id', $product->child_cat_id)->value('title') }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Brand:</strong>
                                                                        <p>{{\App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Size:</strong>
                                                                        <button class="btn btn-sm btn-success btn-border">{{ $product->size }}</button>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Vendor:</strong>
                                                                        <p>{{ \App\Models\User::where('id', $product->vendor_id)->value('full_name') }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Stock:</strong>
                                                                        <p>{{ $product->stock }}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Conditions:</strong>
                                                                        <button class="btn btn-sm btn-primary disabled btn-border">{{ $product->conditions }}</button>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Status:</strong>
                                                                        <button class="btn btn-sm btn-warning disabled btn-border">{{ $product->status }}</button>
                                                                    </div><br>
                                                                    
                                                                </div>
                                                         
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                <a href="{{ route('product.edit', $item->id) }}" type="button" class="btn btn-primary">Edit Product</a>
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
                        text: "Once deleted, you will not be able to recover the Product!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                                swal("Poof! Product Deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Product is Safe!");
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
                        url:"{{ route('product.status') }}",
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


