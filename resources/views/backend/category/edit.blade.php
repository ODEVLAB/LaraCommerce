@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Edit Category</h4>
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
                            <a href="{{ route('category.index') }}">All Categories</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Edit Banner</h4>

                                    <a href="{{route('category.index')}}" class="btn btn-primary btn-round ml-auto">All Categories</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('category.update', $category->id) }}" class="horizontal-form">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{$category->title }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Summary</label>
                                                <textarea name="summary" class="summernote" placeholder="Write Summary">{{$category->summary}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Is Parent:</label>
                                                <input type="checkbox" value="1" id="is_parent" name="is_parent" value="{{ $category->is_parent }}" {{$category->is_parent == true ? 'checked' : ''}}>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $category->is_parent == 1 ? 'd-none' : '' }}" id="parent_cat_div">
                                                <label>Parent Category</label>
                                                <select name="parent_id" class="form-control">
                                                    <option value="">Choose Parent...</option>
                                                    @foreach($parent_cats as $pcats)
                                                        <option value="{{ $pcats->id}}" {{$pcats->id==$category->parent_id ? 'selected' : ''}}>{{ $pcats->title }}</option>
                                                        {{-- <option value="{{ $pcats->id}}" {{ old('parent_id')==$pcats->id ? 'selected' : ''}}>{{ $pcats->title }}</option> --}}
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label >Status</label>
                                                <select name="status" class="form-control">
                                                    <option selected>Choose Status...</option>
                                                    <option value="active" {{$category->status=='active' ? 'selected' : ''}}>Active</option>
                                                    <option value="inactive" {{$category->status=='inactive' ? 'selected' : ''}}>Inactive</option>
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
                                                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}">
                                                </div>
                                                <div id="holder" style="margin-top:15px; max-height:100px;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Update</button>
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
                $('#is_parent').change(function(e){
                    e.preventDefault();
                    var is_checked=$('#is_parent').prop('checked');
                    // alert(is_checked);
                    if(is_checked){
                        $('#parent_cat_div').addClass('d-none');
                        $('#parent_cat_div').val('');
                    }
                    else{
                        $('#parent_cat_div').removeClass('d-none');
                    }
                });
            </script>
@endsection


