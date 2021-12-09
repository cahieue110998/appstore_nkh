@extends('admin.layousts.master')
@section('title')
Add category
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="col-lg-12">
    <div class="breadcrumb-text">
        <a href="admin"><i class="fa fa-home"></i>Trang chủ</a> /
        <a href="{{ route('category.index') }}">Danh mục sản phẩm</a> /
        <a href="{{ route('category.create') }}">Thêm danh mục sản phẩm</a>
    </div>
</div>
<br>
<!-- Breadcrumb Section End -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Category</h6>
    </div>
    <div class="row" style="margin: 5px">

        <div class="col-lg-12">

            <form role="form" action="{{ route('category.store') }}" method="POST">
                @csrf
                <fieldset class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" placeholder="Nhập tên Category">
                </fieldset>

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
