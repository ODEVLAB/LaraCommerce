@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Create Product</h4>
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
                                    <h4 class="card-title">Create Product</h4>

                                    <a href="{{route('product.index')}}" class="btn btn-primary btn-round ml-auto">All Product</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('product.store') }}" class="horizontal-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{old('title') }}" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Summary <span class="text-danger">*</span></label>
                                                <textarea name="summary" class="summernote" placeholder="Write Summary">{{old('summary') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File Upload <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                      </a>
                                                    </span>
                                                    <input id="thumbnail" class="form-control" type="text" name="photo">
                                                </div>
                                                <div id="holder" style="margin-top:15px; max-height:100px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea name="description" class="summernote" placeholder="Write Description">{{old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Stock <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="stock" placeholder="Stock" value="{{old('stock') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price <span class="text-danger">*</span></label>
                                                <input type="number" step="any" name="price" class="form-control" placeholder="Price" value="{{old('price') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Discount  <span class="text-danger">*</span></label>
                                                <input type="number" step="any" name="discount" class="form-control" placeholder="Discount" value="{{old('discount') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select name="brand" class="form-control">
                                                    <option value="">Choose Brand...</option>
                                                    @foreach(\App\Models\Brand::get() as $brand)
                                                        <option value="{{ $brand->id}}">{{ $brand->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select id="cat_id" name="category" class="form-control">
                                                    <option value="">Choose Category...</option>
                                                    @foreach(\App\Models\Category::where('is_parent', 1)->get() as $pcat)
                                                        <option value="{{ $pcat->id}}">{{ $pcat->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-none" id="child_cat_div">
                                            <div class="form-group">
                                                <label>Child Category</label>
                                                <select id="child_cat_id" name="category" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Size</label>
                                                <select name="size" class="form-control">
                                                    <option selected>Choose Size...</option>
                                                    <option value="S" {{old('size')=='S' ? 'selected' : ''}}>Small</option>
                                                    <option value="M" {{old('size')=='M' ? 'selected' : ''}}>Medium</option>
                                                    <option value="L" {{old('size')=='L' ? 'selected' : ''}}>Large</option>
                                                    <option value="XL" {{old('size')=='XL' ? 'selected' : ''}}>Extra Large</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Conditions</label>
                                                <select name="conditions" class="form-control">
                                                    <option selected>Choose Conditions...</option>
                                                    <option value="new" {{old('conditions')=='new' ? 'selected' : ''}}>New</option>
                                                    <option value="popular" {{old('conditions')=='popular' ? 'selected' : ''}}>Popular</option>
                                                    <option value="winter" {{old('conditions')=='winter' ? 'selected' : ''}}>Winter</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Vendors</label>
                                                <select name="vendors" class="form-control">
                                                    <option selected>Choose Vendors...</option>
                                                    @foreach(\App\Models\User::where('role', 'vendor')->get() as $vendor)
                                                        <option value="{{ $vendor->id}}">{{ $vendor->full_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Status</label>
                                                <select name="status" class="form-control">
                                                    <option selected>Choose Status...</option>
                                                    <option value="new" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                                    <option value="popular" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>File Upload</label>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                      </a>
                                                    </span>
                                                    <input id="thumbnail" class="form-control" type="text" name="photo">
                                                </div>
                                                <div id="holder" style="margin-top:15px; max-height:100px;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection


        @section('scripts')
            <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
            <script>
                $('#lfm').filemanager('image');
            </script>

            <script>
                $('#cat_id').change(function(){
                    var cat_id = $(this).val();
                    // alert(cat_id);
                    if(cat_id !=null){
                        $.ajax({
                            url: "/admin/category/"+cat_id+"/child",
                            type: "POST",
                            data:{
                                _token: "{{csrf_token()}}",
                                cat_id: cat_id,
                            } ,
                            success: function(response){
                                // console.log(response);
                                var html_option="<option value=''>-- Choose Child Category --- </option>";
                                if(response.status){
                                    $('#child_cat_div').removeClass('d-none');
                                    $.each(response.data, function(id, title){
                                        html_option +="<option value='"+id+"'>"+title+"</option>"
                                    });
                                }
                                else{
                                    // alert('no child category');
                                    $('#child_cat_div').addClass('d-none');
                                }
                                $('#child_cat_id').html(html_option);
                            }
                        })
                    }
                });
            </script>
@endsection


