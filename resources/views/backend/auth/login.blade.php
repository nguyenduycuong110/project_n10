<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ config('apps.general.sys_admin') }}</title>

        <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

        <link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/css/customize.css') }}" rel="stylesheet">

    </head>

    <body class="gray-bg">

        <div class="loginColumns animated fadeInDown">
            <div class="row">

                <div class="col-md-6">
                    <h2 class="font-bold">Welcome {{ config('apps.general.sys_admin') }}</h2>

                    <p>
                        Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>

                    <p>
                        When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>

                </div>
                <div class="col-md-6">
                    <div class="ibox-content">
                      
                        <form method="post" class="m-t" role="form" action="{{ route('auth.login') }}">
                            @csrf
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    name="email"
                                    class="form-control" 
                                    placeholder="Email" 
                                    value="{{ old('email') }}"
                                >
                                @if ($errors->has('email'))
                                    <span class="error-message">* {{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input 
                                    type="password" 
                                    name="password"
                                    class="form-control" 
                                    placeholder="Password" 
                                >
                                @if ($errors->has('password'))
                                    <span class="error-message">* {{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

                            <a href="#" class="btn-fg ">
                                <small>Forgot password?</small>
                            </a>
                        </form>
                        <p class="m-t">
                            <small>Newbie Code @<?php echo Date('Y') ?></small>
                        </p>
                    </div>
                </div>
            </div>
            <hr/>
        </div>

    </body>

</html>
<style>
    .loginColumns p{
        text-align: justify;
    }
    .btn-fg{
        display: block;
        margin-top: 5px;
    }
    .m-t{
        margin-top: 10px !important;
    }
</style>

