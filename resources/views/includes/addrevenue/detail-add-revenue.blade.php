<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')
                <div class="container">
                    <h1 class="text-center leader-title">Chi tiết cộng doanh số </h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @php
                                $date = date(' d-m-Y', strtotime($addrevenueDetail['created_at']));
								$time = date(' H:i', strtotime($addrevenueDetail['created_at']));
                            @endphp
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Người cộng doanh số</th>
                                            <th>{!!$addrevenueDetail['user_create']['name']!!}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại người cộng doanh số</th>
                                            <th>{{$addrevenueDetail['user_create']['phone']}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Người nhận</th>
                                            <th>{{$addrevenueDetail['user']['name']}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại người nhận</th>
                                            <th>{{$addrevenueDetail['user']['phone']}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Giá mua</th>
                                            <th>{{number_format($addrevenueDetail['price'])}} VNĐ</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Thời gian mua</th>
                                            <th>{{$date}}<br>{{$time}}</th>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Nội dung mua</th>
                                            <th><p><span style="width:100%;">{!!$addrevenueDetail['content']!!}</span></p></th>
                                            
                                        </tr>
                                    </thead>
                                   
                                  
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @include('layout/footer')
        </div>


    </div>



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layout/libjs')

</body>

</html>
