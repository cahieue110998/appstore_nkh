<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +84 954.56.91.11</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> Cahieue1109981@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="assets/client/images/home/logo.png" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                    $cart = Cart::content();
                ?>
                <script laguage="javascript">
                    function show_message1(){
                        alert('B???n ch??a c?? s???n ph???m n??o trong gi??? h??ng');
                    }
                    function show_message2(){
                        alert('B???n ch??a ????ng nh???p');
                    }
                </script>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a
                                @if(Auth::check())
                                    @if(count($cart) > 0)
                                        href="checkout"
                                    @else
                                        onclick="show_message1()"
                                    @endif
                                @else
                                    onclick="show_message2()"
                                @endif
                                >
                                <i class="fa fa-crosshairs"></i> Thanh to??n</a>
                            </li>

                            <li><a @if(Auth::check()) href="{{ route('cart.index') }} " @else data-toggle="modal" data-target="#login" href="#" @endif title="Gi??? h??ng b???n c?? {{ Cart::count() }} m???t h??ng"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>
                            @if(Auth::check())
                                <li class="text-center border-right text-white">
                                    <a href="logout" title="????ng xu???t" onclick="return confirm('B???n c?? mu???n ????ng xu???t kh??ng?')"><i class="fa fa-sign-in"></i>{{ Auth::user()->name }} </a>
                                </li>
                                @if(Auth::user()->password == '')
                                <div class="modal fade updatePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">C???p nh???t m???t kh???u<span class="title"></span></h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row" style="margin: 5px">
                                                    <div class="col-lg-12">
                                                        <form role="form" action="{{ route('updatepassword') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label class="col-form-label">M???t kh???u</label>
                                                                <input type="password" class="form-control" name="password" placeholder="Nh???p m???t kh???u m???i">
                                                            </div>
                                                            @if($errors->has('password'))
                                                            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                                                            @endif
                                                            <div class="form-group">
                                                                <label class="col-form-label">Nh???p l???i m???t kh???u</label>
                                                                <input type="password" class="form-control" name="re_password" placeholder="Nh???p l???i m???t kh???u">
                                                            </div>
                                                            @if($errors->has('re_password'))
                                                            <p class="alert alert-danger">{{ $errors->first('re_password') }}</p>
                                                            @endif
                                                            <div class="right-w3l">
                                                                <input type="submit" class="form-control" value="C???p nh???t">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @else
                                <li class="text-center border-right text-white">
                                    <a href="#" data-toggle="modal" data-target="#login" class="text-white"><i class="fa fa-lock"> ????ng nh???p</i></a>
                                </li>
                                <li class="text-center text-white">
                                    <a href="#" data-toggle="modal" data-target="#register" class="text-white"><i class="fa fa-users"> ????ng k??</i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Trang ch???</a></li>
                            <li class="dropdown"><a href="#">S???n ph???m<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/">S???n ph???m</a></li>
                                    <li><a
                                        @if(Auth::check())
                                            @if(count($cart) > 0)
                                                href="checkout"
                                            @else
                                                onclick="show_message1()"
                                            @endif
                                        @else
                                            onclick="show_message2()"
                                        @endif
                                        >Thanh to??n</a></li>
                                    <li><a @if(Auth::check()) href="{{ route('cart.index') }} " @else data-toggle="modal" data-target="#login" href="#" @endif title="Gi??? h??ng b???n c?? {{ Cart::count() }} m???t h??ng">Gi??? h??ng</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Tin t???c</a>
                            </li>
                            <li><a @if(Auth::check()) href="{{ route('cart.index') }} " @else data-toggle="modal" data-target="#login" href="#" @endif title="Gi??? h??ng b???n c?? {{ Cart::count() }} m???t h??ng">Gi??? h??ng</a></li>
                            <li><a href="contact-us.html">Li??n h???</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <form action="{{ route('search') }}" method="post">
                        @csrf
                        <div class="search_box pull-right">
                            <div class="col-sm-9">
                                <input type="text" name="keywords" placeholder="Search" style="width: 100%"/>
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="search_items" value="T??m ki???m" class="btn btn-default btn-sm" style="color: #666"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
