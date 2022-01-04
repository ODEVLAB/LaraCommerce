@extends('backend.layouts.master')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Create User</h4>
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
                                    <h4 class="card-title">New User</h4>

                                    <a href="{{route('banner.index')}}" class="btn btn-primary btn-round ml-auto">All Users</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('user.store') }}" class="horizontal-form">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{old('full_name') }}" placeholder="Full Name">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" id="username" name="username" value="{{old('username') }}" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{old('email') }}" placeholder="Email Address">
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" value="{{old('password') }}" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{old('address') }}" placeholder="Address">
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone') }}" placeholder="Phone Number">
                                                    </div>
                                                </div>
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputState">Role <span class="required">*</span></label>
                                                    <select name="condition" class="form-control">
                                                        <option selected>Choose Role...</option>
                                                        <option value="Admin" {{old('role')=='admin' ? 'selected' : ''}}> Administrator</option>
                                                        <option value="Customer" {{old('role')=='customer' ? 'selected' : ''}}> Customer</option>
                                                        <option value="Vendor" {{old('role')=='vendor' ? 'selected' : ''}}> Vendor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label >Status</label>
                                                <select name="status" class="form-control">
                                                    <option selected>Choose Status...</option>
                                                    <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                                    <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                                                </select>
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
@endsection
