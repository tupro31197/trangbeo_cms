<?php

$money_recharge = $recharge['total']['total_money'];
$money_withdraw = $withdraw['total']['total_money'];
$money = $money_recharge - $money_withdraw;

$currentPage1 = $recharge['recharge_wallet']['current_page'];
$totalPage1 = $recharge['recharge_wallet']['last_page'];

$currentPage2 = $withdraw['withdraw_wallet']['current_page'];
$totalPage2 = $withdraw['withdraw_wallet']['last_page'];
$currentPage = $currentPage1;
$totalPage = $totalPage1;
if($totalPage < $totalPage2){
    $totalPage = $totalPage2;
}

?>
@extends('layouts.app')
@section('title-page', 'Ví tiền')
@section('content')


    <section class="content">


        <div class="container">

            <h1 class="text-center leader-title">Lịch sử giao dịch ví tiền:</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3 row">
                  
                     <table boder="none">
                         <tr>
                             <th class="text-right">Tên:</th>
                             <th class="pl-2">{{($recharge['total']['name'])}} </th>
                         </tr>
                         <tr>
                             <th class="text-right">Tổng tiền ví:</th>
                             <th class="pl-2">{{ number_format($money)}} VNĐ </th>
                         </tr>
                     </table>
                     <div style="position: absolute;
    right: 6%;"><a href="{{ route('addWallet') }}" class="btn btn-info">Thêm mới</a>
                        </div>

                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="" style="display:block !important">
                        <div class="input-group">
                          
                             <label for="" style="margin-left:100px; padding-right:5px;">Trạng thái:</label>
                           <select name="status" id="" class="form-control  border-1 small">
                               <option value="0" @if($status == 0) {{"selected"}} @endif>Chờ xác nhận</option>
                               <option value="1" @if($status == 1) {{"selected"}} @endif>Đã hoàn thành</option>
                               <option value="2" @if($status == 2) {{"selected"}} @endif>Đã huỷ</option>
                           </select>
                            <label for="" style="margin-left:20px; padding-right:5px;">Từ ngày:</label>
                            <input type="date" name="from_date" class="form-control  border-1 small"
                                value="<?php if (isset($_GET['from_date'])) {
                                    echo $_GET['from_date'];
                                } ?>">
                            <label for="" style="margin-left:20px;padding-right:5px;">Đến ngày:</label>
                            <input type="date" name="to_date" class="form-control  border-1 small"
                                value="<?php if (isset($_GET['to_date'])) {
                                    echo $_GET['to_date'];
                                } ?>">
                            <div class="input-group-append" style="margin-left:20px;">
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
                        
                        <ul class="nav nav-tabs ml-2 mr-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#dataTable">Rút tiền</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dataTable2">Nạp tiền</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div id="dataTable" class="container tab-pane active">
                                <table class="table table-bordered" width="100%" cellspacing="0" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên tài khoản</th>
                                            <th>Số tài khoản</th>
                                            <th>Tên ngân hàng</th>
                                            <th>Chi nhánh</td>
                                            <th>Số tiền</th>
                                            {{-- <th>Nội dung</th> --}}
                                            <th>Trạng thái</th>
                                            <th style="width: 80px;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($withdraw['withdraw_wallet']['data']) && $withdraw['withdraw_wallet']['data'] != null) { ?>
                                        @foreach ($withdraw['withdraw_wallet']['data'] as $index => $item)
                                            @php
                                                if ($item['status'] == 0) {
                                                    $status = 'Chờ xác nhận';
                                                } elseif($item['status'] == 1) {
                                                    $status = 'Đã hoàn thành';
                                                }else{
                                                    $status = 'Đã huỷ';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['account_name'] }}</td>
                                                <td>{{ $item['account_stk'] }}</td>
                                                <td>{{ $item['bank_name'] }} </td>
                                                <td>{{ $item['branch'] }}</td>
                                                <td>{{ number_format($item['money']) }} VNĐ </td>
                                                {{-- <td>{!! $item['content'] !!} </td> --}}
                                                <td>{!! $status !!}</td>


                                                <td>
                                                    <a href="{{ asset('chi-tiet-giao-dich/rut-tien/id=' . $item['id']) }}">
                                                        <i class="fas fa-eye" style="cursor: pointer;"></i>
                                                    </a>

                                                </td>
                                            </tr>


                                        @endforeach
                                        <?php }  ?>


                                    </tbody>
                                </table>
                            </div>
                            <div id="dataTable2" class="container tab-pane">
                                <table class="table table-bordered" width="100%" cellspacing="0" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên tài khoản</th>
                                            <th>Số tài khoản</th>
                                            <th>Tên ngân hàng</th>
                                            <th>Chi nhánh</td>
                                            <th>Số tiền</th>
                                            {{-- <th>Nội dung</th> --}}
                                            <th>Trạng thái</th>
                                            <th style="width: 80px;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($recharge['recharge_wallet']['data']) && $recharge['recharge_wallet']['data'] != null) { ?>
                                        @foreach ($recharge['recharge_wallet']['data'] as $index => $item)
                                            @php
                                                if ($item['status'] == 1) {
                                                    $status = 'Đã hoàn thành';
                                                } else {
                                                    $status = 'Chờ xác nhận';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['account_name'] }}</td>
                                                <td>{{ $item['account_stk'] }}</td>
                                                <td> {{ $item['bank_name'] }}</td>
                                                <td>{{ $item['branch'] }}</td>
                                                <td>{{ number_format($item['money']) }} VNĐ </td>
                                                {{-- <td>{!! $item['content'] !!} </td> --}}
                                                <td>{!! $status !!}</td>


                                                <td>
                                                    <a href="{{ asset('chi-tiet-giao-dich/nap-tien/id=' . $item['id']) }}">
                                                        <i class="fas fa-eye" style="cursor: pointer;"></i>
                                                    </a>

                                                </td>
                                            </tr>


                                        @endforeach
                                        <?php } ?>


                                    </tbody>
                                </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
                     {{-- ======= phân trang ======== --}}
                     <ul class="pagination justify-content-end">
                        <li class="page-item"><a class="page-link" href="{{ asset('vi-tien/1') }}">Đầu</a>
                        </li>

                        @if (($currentPage - 1) >= 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ asset('vi-tien/' . ($currentPage - 1)) }}">
                                    <i class="fas fa-angle-left"></i></a>
                            </li>
                            @endif @if (($currentPage - 1) >= 1)
                                <li class="page-item"><a class="page-link"
                                        href="{{ asset('vi-tien/' . ($currentPage - 1)) }}">{{ ($currentPage - 1) }}</a>
                                </li>
                            @endif
                            <li class="page-item {{ 'active' }}"><a class="page-link"
                                    href="{{ asset('vi-tien/' . $currentPage) }}">{{ $currentPage }}</a>
                            </li>
                            @if (($currentPage + 1) <= $totalPage)
                                <li class="page-item "><a class="page-link"
                                        href="{{ asset('vi-tien/' . ($currentPage + 1)) }}">{{ ($currentPage + 1) }}</a>
                                </li>
                                @endif {{-- @endfor --}} @if (($currentPage + 1) <= $totalPage)
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ asset('vi-tien/' . ($currentPage + 1)) }}"> <i
                                                class="fas fa-angle-right"></i></a>
                                    </li>
                                @endif
                                <li class="page-item"><a class="page-link"
                                        href="{{ asset('vi-tien/' . $totalPage) }}">Cuối</a></li>
                    </ul>
                    {{-- ==========hết phân trang ============ --}}
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
