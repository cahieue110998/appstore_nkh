@extends('admin.layousts.master')
@section('title')
Products
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="col-lg-12">
    <div class="breadcrumb-text">
        <a href="admin"><i class="fa fa-home"></i>Trang chủ</a> /
        <a href="{{ route('product.index') }}"> Sản phẩm</a>
    </div>
    <br>
    <a href="{{ route('product.create') }}">
        <i class="fa fa-plus-circle"> Thêm sản phẩm</i>
    </a>
</div>
<br>

<!-- Breadcrumb Section End -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Thông tin</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Status</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Thông tin</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Status</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($product as $key => $value )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->slug }}</td>
                        <td>{!! $value->description !!}</td>
                        <td>
                            <b>Số lượng</b>: {{ $value->quantity}}
                            <br/>
                            <b>Đơn giá</b>: {{ $value->price}}
                            <br/>
                            <b>Khuyến mại</b>: {{ $value->promotional}}
                            <br/>
                            <b>Hình minh họa</b>: <img src="img/upload/product/{{ $value->image}}" alt="" width="100" height="100">
                            <br/>
                        </td>
                        <td>{{ $value->Category->name}}</td>
                        <td>{{ $value->productType->name}}</td>
                        <td>
                            @if($value->status == 1)
                                {{ "Hiển thị" }}
                            @else
                                {{ "Không hiển thị" }}
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary editProduct" title="{{ "Sửa ".$value->name }}" data-toggle="modal" data-target="#edit" type="button" data-id={{ $value->id }}><i class="fas fa-edit"></i></button>
		                    <button class="btn btn-danger deleteProduct" title="{{ "Xóa ".$value->name }}" data-toggle="modal" data-target="#delete" type="button" data-id={{ $value->id }}><i class="fas fa-trash-alt"></i></button>
		                </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="pull-right">{{ $product->links() }}</div>
        </div>
    </div>
</div>
<!-- Edit Modal-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm <span class="title"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form" id="updateProduct" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset class="form-group">
                            <label>Tên sản phẩm</label>
                            <input class="form-control name" name="name" placeholder="Nhập tên sản phẩm">
                            </fieldset>
                            <div class="alert alert-danger errorName" style="color: red; font-size: 1rem; width: 100%;"></div>

                            <div class="form-group">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control cateProduct" name="idCategory">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control proTypeProduct" name="idProductType">

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Số lượng</label>
                                <input type="number" name="quantity" id="" min="1" value="1" class="form-control quantity">
                            </div>
                            <div class="alert alert-danger errorQuantity" style="color: red; font-size: 1rem; width: 100%;"></div>

                            <div class="form-group">
                                <label for="price">Đơn giá</label>
                                <input type="number" name="price" placeholder="Nhập đơn giá" class="form-control price">
                            </div>
                            <div class="alert alert-danger errorPrice" style="color: red; font-size: 1rem; width: 100%;"></div>

                            <div class="form-group">
                                <label for="promotional">Giá khuyến mại</label>
                                <input type="text" name="promotional" value="0" placeholder="Nhập giá khuyến mãi nếu có" class="form-control promotional">
                            </div>
                            <div class="alert alert-danger errorPromotional" style="color: red; font-size: 1rem; width: 100%;"></div>

                            <div class="form-group">
                                <label for="description">Mô tả sản phẩm</label>
                                <textarea name="description" id="demo" cols="5" rows="5" class="form-control description"></textarea>
                            </div>
                            <div class="alert alert-danger errorDescription" style="color: red; font-size: 1rem; width: 100%;"></div>

                            <img class="img img-thumbnail imageThum" width="100" height="100" lign="center">
                            <div class="form-group">
                                <label for="image">Hình ảnh minh họa</label>
                                <input type="file" name="image" class="form-control image" >
                            </div>
                            <div class="alert alert-danger errorImage" style="color: red; font-size: 1rem; width: 100%;"></div>

                            <div class="form-group">
                            <label>Status</label>
                            <select class="form-control status" name="status">
                                <option value="1" class="ht">Hiển thị</option>
                                <option value="0" class="kht">Không hiển thị</option>
                            </select>
                            </div>

                                <input type="submit" class="btn btn-success" value="Save">
                                <button type="reset" class="btn btn-primary">Làm Lại</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="margin-left: 183px;">
                <button type="button" class="btn btn-success delProduct">Có</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
            <div>
        </div>
    </div>
</div>
@endsection
