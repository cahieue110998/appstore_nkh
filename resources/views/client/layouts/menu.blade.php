<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                @foreach ($category as $cate)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{ URL::to('/danh-muc-san-pham/'.$cate->id) }}">{{ $cate->name }}</a>
                        </h4>
                    </div>
                </div>
                @endforeach
            </div>
        <!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($producttype as $protype)
                        <li><a href="{{ URL::to('/loai-san-pham/'.$protype->id) }}"> <span class="pull-right">({{ count($protype->Products) }})</span>{{ $protype->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="shipping text-center"><!--shipping-->
            <img src="assets/client/images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->

    </div>
</div>
