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
    $data = $client->get(\App\Models\BaseModel::URI_API . '/ctv/product/detail-cart');
    $response = json_decode($data->getBody()->getContents(), true);
    if($response['status']==1){
        $detail = $response['data'];
        $infor = $detail['user'];
    }
    

}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('template/AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CTV Healthmoomy</span>
    </a>

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
                    {{ $infor['name'] }}
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/trang-chu" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('danh-sach-san-pham/1')}}" class="nav-link">
                        <i class="nav-icon fas fa-book fa-fw"></i>
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('danh-sach-mua-san-pham/1')}}" class="nav-link">
                        <i class=" nav-icon fas fa-folder-open"></i>
                        <p>
                            Quản lý đơn hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ asset('bai-dang/1')}}" class="nav-link">
                        <i class=" nav-icon fas fa-code"></i>
                        <p>
                            Bài đăng
                           
                        </p>
                    </a>
                  
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Gói sữa doanh nghiệp
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{asset('goi-sua')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách gói sữa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{asset('goi-mua-sua')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách mua gói</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class=" nav-icon fas fa-user-friends"> </i>
                        <p>
                            Cộng tác viên
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{asset('ctv-tuyen-duoi')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mua hàng CTV tuyến dưới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{asset('cong-doanh-so')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách cộng doanh số</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-wallet nav-icon"></i>
                        <p>
                            Quản lý tài chính
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{asset('vi-tien/1')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ví tiền</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{asset('vi-thuong/1')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ví thưởng</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
