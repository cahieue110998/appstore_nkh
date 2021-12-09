<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Hiểu <sup>Khoai</sup>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span>
        </a>
    </li>

    <!-- Divider -->
    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Danh mục sản phẩm
        </div>

        <!-- Nav Item - Pages Collapse Menu -->

        {{--  Categories  --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-list-alt"></i>
                <span>CATEGORIES</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Danh mục sản phẩm</h6>
                    <a class="collapse-item" href="{{ route('category.index') }}">Danh sách</a>
                    <a class="collapse-item" href="{{ route('category.create') }}">Thêm mới</a>
                </div>
            </div>
        </li>

        {{--  Product Types  --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#producttype" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>PRODUCT TYPES</span>
            </a>
            <div id="producttype" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loại sản phẩm</h6>
                    <a class="collapse-item" href="{{ route('producttype.index') }}">Danh sách</a>
                    <a class="collapse-item" href="{{ route('producttype.create') }}">Thêm mới</a>
                </div>
            </div>
        </li>
    @endif



    <!-- Divider -->
    @if(Auth::user()->role == 1 || Auth::user()->role == 3)
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Sản phẩm
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        {{--  Products  --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>PRODUCTS</span>
            </a>
            <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sản phẩm</h6>
                    <a class="collapse-item" href="{{ route('product.index') }}">Danh sách</a>
                    <a class="collapse-item" href="{{ route('product.create') }}">Thêm mới</a>
                </div>
            </div>
        </li>
    @endif

</ul>
