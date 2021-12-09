@extends('client.layouts.master')

@section('title')
    Danh mục sản phẩm
@endsection

@section('slider')
    @include('client.layouts.slider')
@endsection

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            @foreach ($category_name as $cate_name)
            <h2 class="title text-center">{{ $cate_name->name }}</h2>
            @endforeach

            @foreach ($category_product as $catePro)
            <a href="{{ URL::to('/chi-tiet-san-pham/'.$catePro->id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="img/upload/product/{{ $catePro->image }}" alt="" />
                                    <h2>{{ number_format($catePro->price).' '.'VNĐ' }}</h2>
                                    <p>{{ $catePro->name }}</p>
                                    <form action="{{ route('addCart',['id'=>$catePro->id]) }}" method="post">
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
                    </div>
                </div>
            </a>
            @endforeach

        </div><!--features_items-->

        <!--/recommended_items-->

    </div>
@endsection
