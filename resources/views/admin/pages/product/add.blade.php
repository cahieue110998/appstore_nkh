@extends('admin.layousts.master')
@section('title')
Add Product
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="col-lg-12">
    <div class="breadcrumb-text">
        <a href="admin"><i class="fa fa-home"></i>Trang chủ</a> /
        <a href="{{ route('product.index') }}">Sản phẩm</a> /
        <a href="{{ route('product.create') }}">Thêm sản phẩm</a>
    </div>
</div>
<br>
<!-- Breadcrumb Section End -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
    </div>
    <div class="row" style="margin: 5px">

        <div class="col-lg-12">

            <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="form-group">
                <label>Tên sản phẩm</label>
                <input class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                </fieldset>
                @error('name')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label>Danh mục sản phẩm</label>
                    <select class="form-control cateProduct" name="idCategory">
                        @foreach ($category as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <select class="form-control proTypeProduct" name="idProductType">
                        @foreach ($producttype as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" name="quantity" id="" min="1" value="1" class="form-control">
                </div>
                @error('quantity')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="price">Đơn giá</label>
                    <input type="number" name="price" placeholder="Nhập đơn giá" class="form-control">
                </div>
                @error('price')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="promotional">Giá khuyến mại</label>
                    <input type="text" name="promotional" value="0" placeholder="Nhập giá khuyến mãi nếu có" class="form-control">
                </div>
                @error('promotional')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" id="demo" cols="5" rows="5" class="form-control"></textarea>
                </div>
                @error('description')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="image">Hình ảnh minh họa</label>
                    <input type="file" name="image" class="form-control">
                </div>
                @error('image')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

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
