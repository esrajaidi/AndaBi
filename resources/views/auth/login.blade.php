<html lang="ar" dir="rtl" class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>تسجيل دخول </title>
    <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugin/waves/waves.min.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    @include('sweetalert::alert')

    <div id="single-wrapper">
        <div class="frm-single">
            <div class="inside">

                <form method="POST" action="{{ route('login/login') }}">
                    @csrf

                    <div class="title"> منظومة الاسماء المحظور المحلية</div>
                    <!-- /.title -->
                    <div class="frm-title">{{ __('login.Login') }}</div>
                    <img src="{{ asset('assets/images/anda_logo.png') }}" alt="">
                    <!-- /.frm-title -->
                    <div class="frm-input">
                        <input id="username" type="text" class="frm-inp @error('username') is-invalid @enderror"
                            placeholder="{{ __('login.username') }}" name="username" value="{{ old('username') }}"
                            requiredautocomplete="username" autofocus><i class="fa fa-user frm-ico"></i>
                    </div>

                    @error('username')
                        <div class="help-block" style="color:red">{{ $message }}</div>
                    @enderror

                    <!-- /.frm-input -->
                    <div class="frm-input">
                        <input type="password" id="password" placeholder="{{ __('login.password') }}"
                            class="frm-inp @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password"><i class="fa fa-lock frm-ico"></i>
                    </div>

                    @error('password')
                        <div class="help-block" style="color:red">{{ $message }}</div>
                    @enderror

                    <div class="form-group row ">
                        <div class="col-md-8">

                            <div class="captcha" align="center" style="padding: 3px">

                                <span>{!! captcha_img() !!}</span>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <button type="button" onclick="refreshcaptcha()" style="background: #0182bf"
                                class="btn btn-primary btn-block btn-signin"><i class="fa fa-refresh"
                                    id="refresh"></i></button>

                        </div>
                    </div>
                    <div class="form-group mg-b-50">
                        <input id="captcha" type="captcha" class="form-control @error('captcha') is-invalid @enderror"
                            placeholder="الرجاء إدخال الرمز" name="captcha">

                        @error('captcha')
                            <span class="invalid-feedback" style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- /.frm-input -->
                    <div class="clearfix margin-bottom-20">
                        <div class="pull-left checkbox primary">

                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('login.Remember Me') }}
                            </label>
                        </div>
                        <!-- /.pull-left -->

                        @if (Route::has('password.request'))
                            {{-- <div class="pull-right"><a href="{{ route('password.request') }}" class="a-link"><i class="fa fa-unlock-alt"></i> {{ __('login.Forgot Your Password?') }}</a></div> --}}
                        @endif

                        <!-- /.pull-right -->
                    </div>
                    <!-- /.clearfix -->
                    <button type="submit" class="frm-submit">تسجيل دخول<i
                            class="fa fa-arrow-circle-right"></i></button>

                    <!-- /.row -->
                    {{-- <a href="page-register.html" class="a-link"><i class="fa fa-key"></i> to injaAdmin? .</a> --}}
                    <div class="frm-footer">الأندلس © 2024.</div>
                    <!-- /.footer -->
                </form>
            </div>
            <!-- .inside -->
        </div>
        <!-- /.frm-single -->
    </div><!--/#single-wrapper -->
    <script>
        function refreshcaptcha() {
            $.ajax({
                type: 'GET',
                url: 'refreshcaptcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        }
    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="assets/script/html5shiv.min.js"></script>
  <script src="assets/script/respond.min.js"></script>
 <![endif]-->
    <!--
 ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('assets/plugin/waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/main.min.js') }}"></script>

</body>

</html>
