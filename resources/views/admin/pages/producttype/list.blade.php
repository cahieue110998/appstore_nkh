@extends('admin.layousts.master')
@section('title')
Product_Types
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="col-lg-12">
    <div class="breadcrumb-text">
        <a href="admin"><i class="fa fa-home"></i>Trang chủ</a> /
        <a href="{{ route('producttype.index') }}">Loại sản phẩm</a>
    </div>
    <br>
    <a href="{{ route('producttype.create') }}">
        <i class="fa fa-plus-circle"> Thêm loại sản phẩm</i>
    </a>
</div>
<br>
<!-- Breadcrumb Section End -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Loại sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($productType as $key => $value )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->slug }}</td>
                        <td>{{ $value->Category->name }}</td>
                        <td>
                            @if($value->status == 1)
                                {{ "Hiển thị" }}
                            @else
                                {{ "Không hiển thị" }}
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary editProductType" title="{{ "Sửa ".$value->name }}" data-toggle="modal" data-target="#edit" type="button" data-id={{ $value->id }}><i class="fas fa-edit"></i></button>
		                    <button class="btn btn-danger deleteProductType" title="{{ "Xóa ".$value->name }}" data-toggle="modal" data-target="#delete" type="button" data-id={{ $value->id }}><i class="fas fa-trash-alt"></i></button>
		                    </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="pull-right">{{ $productType->links() }}</div>
        </div>
    </div>
</div>
<!-- Edit Modal-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa category <span class="title"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form">
                            <fieldset class="form-group">
                            <label>Name</label>
                            <input class="form-control name" name="name" placeholder="Nhập tên loại sản phẩm">
                            </fieldset>

                            <p class="alert alert-danger error" style="color: red; font-size: 1rem; width: 100%;"></p>

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control idCategory" name="idCategory">

                                </select>
                            </div>

                            <div class="form-group">
                            <label>Status</label>
                            <select class="form-control status" name="status">
                                <option value="1" class="ht">Hiển thị</option>
                                <option value="0" class="kht">Không hiển thị</option>
                            </select>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success updateProductType">Save</button>
                <button type="reset" class="btn btn-primary">Làm Lại</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
                <button type="button" class="btn btn-success delProductType">Có</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
            <div>
        </div>
    </div>
</div>
@endsection
