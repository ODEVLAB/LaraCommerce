<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									OdevLAB Creations
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="#" >
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                    <h4 class="text-section">Features</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#banner">
                        <i class="fas fa-layer-group"></i>
                        <p>Banners</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="banner">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('banner.create') }}">
                                    <span class="sub-item">New Banner</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('banner.index') }}">
                                    <span class="sub-item">All Banners</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#brand">
                        <i class="fas fa-boxes"></i>
                        <p>Brands</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="brand">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('brand.create') }}">
                                    <span class="sub-item">New Brand</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('brand.index') }}">
                                    <span class="sub-item">All Brands</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#category">
                        <i class="fas fa-coins"></i>
                        <p>Categories</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('category.create') }}">
                                    <span class="sub-item">New Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}">
                                    <span class="sub-item">All Categories</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#product">
                        <i class="fas fa-project-diagram"></i>
                        <p>Products</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('product.create') }}">
                                    <span class="sub-item">New Product</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product.index') }}">
                                    <span class="sub-item">All Products</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#user">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('user.create') }}">
                                    <span class="sub-item">New User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.index') }}">
                                    <span class="sub-item">All Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Cart Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="cart">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">####</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
