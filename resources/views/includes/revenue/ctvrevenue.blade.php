<?php
$token = Cookie::get('token'); ?>
@extends('layouts.app')
@section('title-page', 'Doanh thu CTV cấp dưới')
@section('content')


    <section class="content">


                <div class="container">
                    
                    <h1 class="text-center leader-title">Danh thu CTV cấp dưới</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p>Tổng doanh thu: {{number_format($revenue['total_money_ctv'])}} VNĐ <br>
                                Tổng số cộng tác viên tuyến dưới: {{$revenue['quantity_ctv']}}</p>
                            
                            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="">
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control  border-1 small" placeholder="Nhập tên" value="<?php if(isset($_GET['name']))  echo $_GET['name'];?>">
                                    <input type="text" name="phone" class="form-control  border-1 small" placeholder="Nhập số điện thoại" style="margin-left:10px;" value="<?php if(isset($_GET['phone']))  echo $_GET['phone'];?>">
                                        <label for="" style="margin-left:10px; padding-right:5px;">Từ ngày:</label>
                                    <input type="date" name="from_date" class="form-control  border-1 small" value="<?php if(isset($_GET['from_date']))  echo $_GET['from_date'];?>" >
                                        <label for="" style="margin-left:10px;padding-right:5px;">Đến ngày:</label>
                                    <input type="date" name="to_date" class="form-control  border-1 small" value="<?php if(isset($_GET['to_date']))  echo $_GET['to_date'];?>">
                                    <div class="input-group-append" style="margin-left:10px;">
                                        <button class="btn btn-primary" type="submit" style="    border-top-left-radius: 5px;
                                        border-bottom-left-radius: 5px;">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="text-right mb-1"><a href="{{asset('excel-ctv')}}" class="btn btn-info">Xuất excel</a></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th style="width: 80px;">Mã</th>
                                            <th>Cấp trên</td>
                                            <th>Doanh thu</th>
                                            <th>Định danh</th>
                                            <th>Cổ phần</th>
                                            <th>Tiền thưởng</th>
                                            
                                            <th style="width: 80px;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            if ($infor['code_ordinal'] == 1) {
                                                    $none = '';
                                                }
                                                else {
                                                    $none = 'None';
                                                }
                                        @endphp
                                      
                                        <?php if (isset($revenue) && $revenue != null) { ?>
                                        @foreach ($revenue['list']['data'] as $item)
                                            @php
                                                $code = $item['code_branch'].'-'. $item['code_ordinal'];
                                                $id = $item['id'];
                                                
                                            @endphp
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td>{!! $item['address'] !!} </td>
                                                <td>{{ $code  }}</td>
                                                <td>{!! $item['user_name_introduce'] !!} </td>
                                                <td>{{ number_format($item['total_money']) }} VNĐ</td>
                                                <td>{!! $item['identifier_name'] !!} </td>
                                                <td>{!! $item['share_number'] !!}</td>
                                                <td>{{ number_format($item['identifier_money']) }} VNĐ</td>
                                                
                                                <td>
                                                    <a href="{{ asset('chi-tiet-doanh-thu/id=' . $id) }}">
                                                        <i class="fas fa-eye" style="cursor: pointer;"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#calculatorModal{{$id}}" class=" {{ $none }}">
                                                        <i class="fas fa-calculator" style="cursor: pointer;float:right;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="calculatorModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                   
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="p-5">
                                                                    <form action="{{route('comfirmDddrevenue')}}" method="post">
                                                                        @csrf
                                                                    <div class="text-center">
                                                                        <h1 class="h4 text-gray-900 mb-4">Cộng doanh thu {{$item['name']}}</h1>
                                                                    </div>
                                                                        <div class="form-group">
                                                                            <label for="">Số tiền</label>
                                                                            <input type="text" class="form-control form-control-user" class="pricefee" data-type="currency" name="price" value="">
                                                                         
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Nội dung</label>
                                                                            <textarea name="content" id="content" rows="5" class="form-control "
                                                                                placeholder="Nội dung "></textarea>
                                                                        </div>
                                                                      <input type="hidden" id="user_id" value="{{$id}}" name="user_id">
                                                                        
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
                                                                            <button  class="btn btn-primary"><a >Thêm</a></button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                            </div>
                                        </div>
                                           
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
    <script type="text/javascript">
     $("input[data-type='currency']").on('keyup', function() {
      var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            if (!isNaN(n)) $(this).val(n.toLocaleString());
            else $(this).val();
        });

    </script>
    
