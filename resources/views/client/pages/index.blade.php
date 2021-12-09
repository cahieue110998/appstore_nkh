@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('slider')
    @include('client.layouts.slider')
@endsection

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Sản phẩm mới nhất</h2>
            @foreach ($product as $pro)
            <a href="{{ URL::to('/chi-tiet-san-pham/'.$pro->id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="img/upload/product/{{ $pro->image }}" alt="" />
                                    <h2>{{ number_format($pro->price).' '.'VNĐ' }}</h2>
                                    <p>{{ $pro->name }}</p>
                                    <form action="{{ route('addCart',['id'=>$pro->id]) }}" method="post">
                                        @csrf
                                        <span>
                                            <button type="submit" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm giỏ hàng
                                            </button>
                                        </span>
                                    </form>
                                </div>

                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div><!--features_items-->

        <!--/recommended_items-->

    </div>
@endsection
