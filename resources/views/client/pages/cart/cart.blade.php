@extends('client.layouts.master')

@section('title')
    Giỏ hàng
@endsection

@section('slider')
    @include('client.layouts.slider')
@endsection

@section('content')
<?php
    $content = Cart::content();
?>
<div class="col-sm-9 padding-right">
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                <li><a href="/">Trang chủ</a></li>
                <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Mô tả</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td class="delete_cart">Chỉnh sửa</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $v_content)

                        <tr>
                            <td class="cart_product">
                                <img src="img/upload/product/{{ $v_content->options->img }}" alt="" width="30%">
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $v_content->name }}</a></h4>
                                <p>Mã ID: {{ $v_content->id }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($v_content->price).' '.'VNĐ' }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="">
                                        <div class="form-group">
                                            <input type="number" name="qty" class="form-control qty" value="{{ $v_content->qty }}" data-id="{{ $v_content->rowId }}" min="1">
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php
                                        $subtotal = $v_content->price * $v_content->qty;
                                        echo number_format($subtotal).' '.'VNĐ';
                                    ?>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <div class="cart_quantity_delete close1" data-id="{{ $v_content->rowId }}"><i class="fa fa-times"></i></div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{ Cart::total().' '.'VNĐ' }}</span></li>
							<li>Thuế <span>{{ Cart::tax().' '.'VNĐ' }}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{ Cart::total().' '.'VNĐ' }}</span></li>
						</ul>
                        @if(count($content) > 0)
                            <a class="btn btn-default check_out" href="/checkout">Tiến hành đặt hàng</a>
                        @else
                            <a class="btn btn-default check_out" href="/">Bạn chưa có mặt hàng trong giỏ hàng</a>
                        @endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
</div>

<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?</h5>
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
