@extends('admin.layousts.master')
@section('title')
Add Product_Type
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="col-lg-12">
    <div class="breadcrumb-text">
        <a href="admin"><i class="fa fa-home"></i>Trang chủ</a> /
        <a href="{{ route('producttype.index') }}">Loại sản phẩm</a> /
        <a href="{{ route('producttype.create') }}">Thêm loại sản phẩm</a>
    </div>
</div>
<br>
<!-- Breadcrumb Section End -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Product Types</h6>
    </div>
    <div class="row" style="margin: 5px">

        <div class="col-lg-12">

            <form role="form" action="{{ route('producttype.store') }}" method="POST">
                @csrf
                <fieldset class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" placeholder="Nhập tên loại sản phẩm">
                </fieldset>

                @error('name')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="idCategory">
                        @foreach ($category as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1">Hiển thị</option>
                    <option value="0">Không hiển thị</option>
                </select>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>

            </form>

        </div>
    </div>
</div>
@endsection
