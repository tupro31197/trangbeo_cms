
<?php
use GuzzleHttp\Client;
$token = Cookie::get('token');
// $name = Cookie::get('name');
if (isset($token) && $token != null) {
    $client = new Client([
        'headers' => [
        'token' => $token,
        'Content-Type' => 'application/json',
        ],
    ]);

    $data2 = $client->get(\App\Models\BaseModel::URI_API . '/get-info-payment');
    $response2 = json_decode($data2->getBody()->getContents(), true);
    $info = '';
    if($response2['status']==1){
        $info = $response2['data'];
        
    }


}

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              Admin
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a  class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal">
                    {{-- {{ route('informationUser') }} --}}
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-700"></i>
                    Thông tin chuyển khoản
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-700"></i>
                    Đăng xuất
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Bạn có chắc chắn muốn đăng xuất?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href=" {{ route('logout') }}">Đăng xuất</a>
               
            </div>
        </div>
    </div>
</div>

{{-- ===== Đổi mật khẩu ===== --}}

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thông tin chuyển khoản</h1>
                        </div>
                        <form class="user" method="post" action="{{ route('updateInfoPayment')}}">
                            @csrf
                           
                            <div class="form-group">
                                <label for="">Họ tên</label>
                                <input type="text" class="form-control form-control-user" id=""
                                    name="name" value="{{ $info['name']}}">
                            </div>
                            <div class="form-group">
                                <label for="">Số tài khoản</label>
                                <input type="text" class="form-control form-control-user" id="" name="bank_number"
                                    value="{{ $info['bank_number']}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tên ngân hàng</label>
                                <input type="text" class="form-control form-control-user" id=""
                                    name="bank_name" value="{{ $info['bank_name']}}">
                            </div> 
                            <div class="form-group">
                                <label for="">Chi nhánh</label>
                                <input type="text" class="form-control form-control-user" id=""
                                    name="agency" value="{{ $info['agency']}}">
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
