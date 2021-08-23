<!-- Main Sidebar Container -->
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
    // $data = $client->get(\App\Models\BaseModel::URI_API . '/ctv/product/detail-cart');
    // $response = json_decode($data->getBody()->getContents(), true);
    // if($response['status']==1){
    //     $detail = $response['data'];
    //     $infor = $detail['user'];
    // }
    

}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="#" class="brand-link">
        <img src="{{ asset('template/AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template/AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    Admin
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href=" {{ asset('danh-muc/danh-muc-cha') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Danh mục
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('danh-sach-san-pham/1')}}" class="nav-link">
                        <i class="nav-icon fas fa-book fa-fw"></i>
                        <p>
                            Món ăn
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('voucher/danh-sach/1')}}" class="nav-link">
                        <i class=" nav-icon fas fa-folder-open"></i>
                        <p>
                            Voucher
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ asset('user/danh-sach/1')}}" class="nav-link">
                        <i class=" nav-icon fas fa-code"></i>
                        <p>
                            Người dùng
                           
                        </p>
                    </a>
                  
                </li>
                <li class="nav-item">
                    <a href="{{ asset('don-hang/danh-sach/1')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Đơn hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('don-hang/danh-sach/1/trang-thai=0')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('don-hang/danh-sach/1/trang-thai=1')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã đặt đơn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('don-hang/danh-sach/1/trang-thai=2')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đang giao</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('don-hang/danh-sach/1/trang-thai=3')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã hoàn thành</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('don-hang/danh-sach/1/trang-thai=4')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã huỷ</p>
                            </a>
                        </li>
                       
                    </ul>
                   
                </li>
                <li class="nav-item">
                    <a href="{{ asset('danh-gia/danh-sach/1')}}" class="nav-link">
                        <i class=" nav-icon fas fa-check"></i>
                        <p>
                            Đánh giá
                           
                        </p>
                    </a>
                  
                </li>
               

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
