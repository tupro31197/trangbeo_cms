<?php
use GuzzleHttp\Client;
$token = Cookie::get('token');
if (isset($token) && $token != null) {
    $client = new Client([
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
        ],
    ]);
    $data = $client->get(\App\Models\BaseModel::URI_API . '/ctv/product/detail-cart');
    $response = json_decode($data->getBody()->getContents(), true);
    if($response['status']==1){
        $detail = $response['data'];
        $infor = $detail['user'];
    }
    

}

?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> --}}

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="{{asset('gio-hang')}}" 
                >
                <i class="fas fa-shopping-cart"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">@if(isset($detail['total_number'])) {{$detail['total_number']}} @endif</span>
            </a>
            <!-- Dropdown - Alerts -->
         
        </li>



        <div class="topbar-divider d-none d-sm-block"></div>
        @php
            if (isset($infor)) {
                $name = $infor['name'];
                $phone = $infor['phone'];
                $cmt = $infor['cmt'];
                $address = $infor['address'];
                $stt = $infor['code_branch'] . '-' . $infor['code_ordinal'];
            } else {
                $name = '';
                $phone = '';
                $cmt = '';
                $address = '';
                $stt = '';
            }
        @endphp
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#profileModal" style="cursor: pointer;">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Thông tin CTV
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#passModal" style="cursor: pointer;">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đổi mật khẩu
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đăng xuất
                </a>
            </div>
        </li>

    </ul>


</nav>

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thông tin CTV</h1>
                        </div>
                        <form class="user" method="put" action="{{ route('updateCTV') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input type="text" class="form-control form-control-user" id="" name="name"
                                    value="{{ $name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" class="form-control form-control-user" id="" name="phone"
                                    value="{{ $phone }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                    value="{{ $address }}" name="address">
                            </div>
                            <div class="form-group">
                                <label for="">Mã STT</label>
                                <input type="text" class="form-control form-control-user" id=""
                                    value="{{ $stt }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Chứng minh thư</label>
                                <input type="text" class="form-control form-control-user" id=""
                                    value="{{ $cmt }}" name="cmt">
                            </div>
                            <div class="form-group" style="position: relative;">
                                <label for="">Link giới thiệu</label>
                                <input type="text" class="form-control form-control-user" id="linkgt" readonly
                                    value="{{ asset('dang-ki?key=' . base64_encode($cmt)) }}"><i
                                    class="fas fa-fw fa-paste" style="right: 15px;
                                                        position: absolute;
                                                        top: 45px; cursor: pointer;" onclick="copytext();"></i>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary"><a>Chỉnh sửa</a></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Đổi mật khẩu</h1>
                        </div>
                        <form class="user" method="put" action="{{ route('PassCTV') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">mật khẩu hiện tại</label>
                                <input type="password" class="form-control form-control-user" id=""
                                    name="current_password" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu mới</label>
                                <input type="password" class="form-control form-control-user" id="" name="password"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label for="">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control form-control-user" id=""
                                    name="password_confirmation" value="">
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary"><a>Chỉnh sửa</a></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    function copytext() {
        var copyText = document.getElementById("linkgt");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    }

</script>
