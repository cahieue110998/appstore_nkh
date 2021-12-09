@extends('admin.layousts.master')

@section('title')
Trang chủ
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="col-lg-12">
    <div class="breadcrumb-text">
        <a href="admin/"><i class="fa fa-home"></i>Trang chủ</a>
    </div>
</div>
<br>
<!-- Breadcrumb Section End -->

<h1 class="h3 mb-4 text-gray-800">Trang chủ</h1>
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            products
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ count($product) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Orders
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ count($order) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-cart-arrow-down fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Users
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{ count($user) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Comments
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            18
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
