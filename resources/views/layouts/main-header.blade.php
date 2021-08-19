<?php
use GuzzleHttp\Client;
$token = Cookie::get('token');
// $name = Cookie::get('name');
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


    $data2 = $client->get(\App\Models\BaseModel::URI_API . '/notify/list-notify');
    $response2 = json_decode($data2->getBody()->getContents(), true);
    if($response2['status']==1){
        $noti = $response2['data'];
        $noty = $noti['count_notify'];
        
    }
    else{
        $noti = '';
        $noty = '';
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
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="{{asset('gio-hang')}}"
                >
                <i class="fas fa-shopping-cart"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-warning navbar-badge">@if(isset($detail['total_number'])) {{$detail['total_number']}} @endif</span>
                {{-- <span class="badge badge-danger badge-counter">@if(isset($detail['total_number'])) {{$detail['total_number']}} @endif</span> --}}
            </a>
            <!-- Dropdown - Alerts -->

        </li>
        <li class="nav-item dropdown">
           
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{$noty}}</span>
              </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="overflow: scroll; max-height: 500px;">
                @if(isset($noti) && $noti !=null)
                @foreach ($noti['list_notify']['data'] as $item)
                @php
                    if ($item['is_view'] == 1) {
                        $class = '';
                    } else {
                        $class = 'font-weight-bold';
                     }
                @endphp
                <form action="{{ route('notify') }}" method="post" class="p-0 m-0">
                    @csrf
                    <button class="dropdown-item d-flex align-items-center" type="submit">
                        <input type="hidden" value="{{ $item['id'] }}" name="notify_id" id="{{ $item['id'] }}">
                        <div class="mr-1">
                          
                            <i class="fas fa-users mr-1"></i>
                           
                        </div>
                        <div>
                            <div class="small text-gray-500">{{$item['created_at']}}</div>
                            <p class="{{$class}}">{!!$item['content']!!}</p>
                        </div>
                    </button>
                    <hr>
                </form>
                @endforeach
                @endif
                
                <a class="dropdown-item text-center small text-gray-500" href="{{asset('thong-bao/page=1')}}">Xem thêm</a>
            
        </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                @php
                    $name = $infor['name'];
                    echo $name;
                @endphp
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('informationCtv') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-700"></i>
                    Thông tin tài khoản
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#passModal" style="cursor: pointer;">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đổi mật khẩu
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
                <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
</div>

{{-- ===== Đổi mật khẩu ===== --}}

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
