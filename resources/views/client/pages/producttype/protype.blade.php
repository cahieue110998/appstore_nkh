@extends('client.layouts.master')

@section('title')
    Thương hiệu sản phẩm
@endsection

@section('slider')
    @include('client.layouts.slider')
@endsection

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            @foreach ($producttype_name as $pro_name)
            <h2 class="title text-center">{{ $pro_name->name }}</h2>
            @endforeach
            @foreach ($producttype_product as $protype)
            <a href="{{ URL::to('/chi-tiet-san-pham/'.$protype->id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="img/upload/product/{{ $protype->image }}" alt="" />
                                    <h2>{{ number_format($protype->price).' '.'VNĐ' }}</h2>
                                    <p>{{ $protype->name }}</p>
                                    <form action="{{ route('addCart',['id'=>$protype->id]) }}" method="post">
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
