<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CTV Healthmoomy - Register</title>

    @include('layout/libcss')

</head>
<?php 
        $key = null;
        if(isset($_GET['key'])){
            $key = base64_decode($_GET['key']); 
        }
?>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-4">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image" style="background:url({{ asset('img/Rectangle.png') }})"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản!</h1>
                            </div>
                            <form class="user" method="post" action="{{route('register')}}">
                                @csrf
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Họ và tên" required>
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                        placeholder="Số điện thoại" required >
                                        <span class="text-danger" id="checkPhone" ></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="cmt" name="cmt"
                                        placeholder="Chứng minh thư" required>
                                        <span class="text-danger" id="checkCmt" ></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="address" name="address"
                                        placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password_confirmation"
                                            id="password_confirmation" placeholder="Nhập lại password" required>
                                            <span class="text-danger" id="checkPassword" ></span>
                                </div>
                                @if(isset($key) && $key != null)
                                <div class="form-group">
                                    <input type="hidden" name="key" id="" value="{{$key}}" >
                                </div>
                                @else
                                <div class="form-group">
                                    <input type="text" name="key" id="" value="" placeholder="Nhập mã người giới thiệu (số CMT/CCCD người giới thiệu)" class="form-control form-control-user" required>
                                </div>
                                @endif
                                <a   >
                                <button type="submit" id="submit" class="btn btn-primary btn-user btn-block" >
                                    Đăng kí tài khoản

                                </button></a>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/">Bạn đã có tài khoản? Đăng nhập!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layout/libjs')

<script>
     $("#phone").keyup(function() {
            // alert(1);
            var phone = $(this).val();
            var checkPhone = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            if (phone != '') {
                if (checkPhone.test(phone) == false) {
                    jQuery("#submit").attr("disabled", true);
                    document.getElementById('checkPhone').innerHTML =
                        'Số điện thoại chưa đúng định dạng!';
                } else {
                    document.getElementById('checkPhone').innerHTML = '';
                    jQuery("#submit").attr("disabled", false);
                }

            }
        });

        $("#cmt").keyup(function() {
            // alert(1);
            var cmt = $(this).val();
            var checkCmt = /^[0-9]{9}$/g;
            var checkCmt2 = /^[0-9]{12}$/g;
            if (cmt != '') {
                if (checkCmt.test(cmt) == true || checkCmt2.test(cmt) == true) {
                    jQuery("#submit").attr("disabled", false);
                    document.getElementById('checkCmt').innerHTML = '';
                    
                } else {
                    jQuery("#submit").attr("disabled", true);
                    document.getElementById('checkCmt').innerHTML =
                        'Số CMT/CCCD có 9 hoặc 12 chữ số!';
                }

            }
        });

        $("#password_confirmation").keyup(function() {
            // alert(1);
            var checkPassword = $(this).val();
            var password = $('#password').val();
            if (checkPassword != '') {
                if (checkPassword != password) {
                    jQuery("#submit").attr("disabled", true);
                    document.getElementById('checkPassword').innerHTML =
                        'Mật khẩu chưa khớp!';
                } else {
                    document.getElementById('checkPassword').innerHTML = '';
                    jQuery("#submit").attr("disabled", false);
                }

            }
        });
</script>
</body>

</html>