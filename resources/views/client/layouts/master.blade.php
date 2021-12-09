<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <title>@yield('title')</title>
    <link href="assets/client/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/client/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/client/css/prettyPhoto.css" rel="stylesheet">
    <link href="assets/client/css/price-range.css" rel="stylesheet">
    <link href="assets/client/css/animate.css" rel="stylesheet">
	<link href="assets/client/css/main.css" rel="stylesheet">
	<link href="assets/client/css/responsive.css" rel="stylesheet">
	<link href="assets/admin/css/toastr.css" rel="stylesheet">
	<link href="assets/client/css/easy-responsive-tabs.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="assets/client/js/html5shiv.js"></script>
    <script src="assets/client/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="assets/client/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/client/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/client/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/client/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/client/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	@include('client.layouts.header')

    <!-- Login Modal-->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng nhập <span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">
                        <div class="col-lg-12">
                            <form role="form" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Địa chỉ Email">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                </div>
                                <div class="right-w3l">
                                    <input type="submit" class="form-control" value="Đăng Nhập">
                                </div>
                                <div class="right-w3l">
                                    <a href="login/facebook" class="btn btn-primary">Đăng nhập bằng facebook</a>
                                </div>
                                <div class="sub-w3l">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" id="customControlAutosizing" class="custom-control-input" name="remember">
                                        <label for="customControlAutosizing" class="custom-control-label">Nhớ Mật Khẩu?</label>
                                    </div>
                                </div>
                                <p class="text-center dont-do mt-3">Bạn chưa có tài khoản?
                                    <a href="" data-toggle="modal" data-target="#register">Đăng Ký Ngay</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal-->

    <!-- Register Modal-->
        <div class="modal fade registerUser" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Đăng kí <span class="title"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="margin: 5px">
                            <div class="col-lg-12">
                                <form role="form" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-form-label">Họ và tên</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên">
                                    </div>
                                    @if($errors->has('name'))
                                    <p class="alert alert-danger errorRegister">{{ $errors->first('name') }}</p>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-form-label">Địa chỉ Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email">
                                    </div>
                                    @if($errors->has('email'))
                                    <p class="alert alert-danger errorRegister">{{ $errors->first('email') }}</p>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-form-label">Mật khẩu</label>
                                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" id="password1">
                                    </div>
                                    @if($errors->has('password'))
                                    <p class="alert alert-danger errorRegister">{{ $errors->first('password') }}</p>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-form-label">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control" name="re_password" placeholder="Nhập lại mật khẩu"  id="password2">
                                    </div>
                                    @if($errors->has('re_password'))
                                    <p class="alert alert-danger errorRegister">{{ $errors->first('re_password') }}</p>
                                    @endif
                                    <div class="right-w3l">
                                        <input type="submit" class="form-control" value="Đăng ký">
                                    </div>
                                    <div class="sub-w3l">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="" id="customControlAutosizing" class="custom-control-input dieukhoan" >
                                            <label for="customControlAutosizing" class="custom-control-label">Đồng ý với <a href="#">điều khoản</a> của chúng tôi</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Register Modal-->

	@yield('slider')

	<section>
		<div class="container">
			<div class="row">

				@include('client.layouts.menu')

				@yield('content')
			</div>
		</div>
	</section>

	@include('client.layouts.footer')

</body>
</html>
