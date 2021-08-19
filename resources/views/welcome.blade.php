<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Admin - Login</title>
    @include('layout/libcss')
</head>

<body class="bg-gradient-primary">
  
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: none"> <img src="{{ asset('img/logo.png') }}" alt="" style="display: block;
                                margin: 100px auto;
                                width: 200px;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                                    </div>
                                    <div style="margin-top: 50px;">

                                    </div>
                                    <form class="user" method="post" action="{{route('login')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="phone" name="phone" aria-describedby="emailHelp"
                                                placeholder="Nhập số điện thoại">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="" name="password" placeholder="Password">
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> --}}
                                        <div style="margin-top: 50px;">

                                        </div>
                                        <button type="submit" style="border: none;background: #fff;width: 100%;">
                                            <a class="btn btn-primary btn-user btn-block">
                                                Đăng nhập
                                            </a>
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="dang-ki">Bạn chưa có tài khoản? Đăng kí!</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('layout/libjs')

</body>
</html>