@extends('layouts.app')
@section('title-page', 'Chi tiết doanh thu CTV cấp dưới')
@section('content')


    <section class="content">

              

                <div class="container">
                    <h1 class="text-center leader-title"> Chi tiết doanh số ctv tuyến dưới</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3>Thông tin cấp trên</h3>
                        </div>
                        <table class="table" boder="none">
                            <tr>
                                <th>Họ tên: </th>
                                <td>{{ $revenueDetail['user']['name']}}</td>
                            </tr>
                            <tr>
                                <th >Số điện thoại: </th>
                                <td>{{ $revenueDetail['user']['phone']}}</td>
                            </tr>
                            <tr>
                                <th>Mã: </th>
                                <td>{{ $revenueDetail['user']['code_branch'].'-'.$revenueDetail['user']['code_ordinal']}}</td>
                            </tr>
                            <tr>
                                <th >Doanh thu: </th>
                                <td>{{ number_format($revenueDetail['user']['total_money'])}} VNĐ</td>
                            </tr>
                            <tr>
                                <th>Định danh: </th>
                                <td>{{ $revenueDetail['user']['identifier_name']}}</td>
                            </tr>
                            <tr>
                                <th >Cổ phần: </th>
                                <td>{{$revenueDetail['user']['share_number']}}</td>
                            </tr>
                            <tr>
                                <th>Tiền thưởng: </th>
                                <td>{{number_format($revenueDetail['user']['identifier_money'])}} VNĐ</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card shadow mb-4">   
                        <div class="card-header py-3">
                            <h3>Danh sách mua gói</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Tên gói</th>
                                            <th>Giá</th>
                                            <th>Thời gian mua</th>
                                            <th>Địa chỉ</th>
                                            <th>Điện thoại</th>
                                            <th>Nội dung mua</th>
                                            <th>Mã</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($revenueDetail) && $revenueDetail != null) { ?>
                                        @foreach ($revenueDetail['list_buy_packet'] as $item)
                                            @php
                                                $date = date(' d-m-Y', strtotime($item['created_at']) + 7 * 60 * 60);
                                                $time = date(' H:i', strtotime($item['created_at']) + 7 * 60 * 60);
                                                $id = $item['id'];
                                            @endphp
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                               
                                                <td>{{ number_format($item['price']) }} VNĐ</td>
                                                <td>{{ $date }}<br>{{ $time }}</td>
                                                <td>{!! $item['address'] !!}</td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td>
                                                    <p class="content-buy-packet">{!! $item['content'] !!}</p>
                                                </td>
                                                <td>{{ $item['code_ctv'] }}</td>
                                               
                                            </tr>
                                            
                                        @endforeach
                                        <?php } else {echo 'dữ liệu trống!';} ?>


                                    </tbody>
                                </table>
                               

                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3>Danh sách CTV tuyến dưới</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Họ và tên</th>
                                            <th>Địa chỉ</th>
                                            <th>Điện thoại</th>
                                            <th>Mã</th>
                                            <th>Doanh thu</th>
                                            <th>Định danh</th>
                                            <th>Cổ phần</th>
                                            <th>Tiền thưởng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        <?php if (isset($revenueDetail) && $revenueDetail != null) { ?>
                                        @foreach ($revenueDetail['list_ctv']['data'] as $ctv)
                                            @php
                                                $date = date(' d-m-Y', strtotime($ctv['created_at']));
                                                $time = date(' H:i', strtotime($ctv['created_at']));
                                                $code = $ctv['code_branch'].'-'. $ctv['code_ordinal'] ;
                                                $id   = $ctv['id'];

                                            @endphp
                                            <tr>
                                                <td>{{ $ctv['name'] }}</td>
                                        
                                                <td>{!! $ctv['address'] !!}</td>
                                                <td>{{ $ctv['phone'] }}</td>
                                                <td>{{ $code }}</td>
                                                <td>{{ number_format($ctv['total_money']) }} VNĐ</td>
                                                <td>{{ $ctv['identifier_name'] }}</td>
                                                <td>{!! $ctv['share_number'] !!}</td>
                                                <td>{{ number_format($ctv['identifier_money']) }} VNĐ</td>
                                                <td>
                                                    <a href="{{ asset('chi-tiet-doanh-thu/id=' . $id) }}">
                                                        <i class="fas fa-eye" style="cursor: pointer;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                        <?php } else {echo 'dữ liệu trống!';} ?>


                                    </tbody>
                                </table>
                               

                            </div>
                        </div>
                    </div>

                </div>
    </section>
          @endsection