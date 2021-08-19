<?php
if (isset($recharge) && $recharge != '') {
    $wallet = 1;
    $detail = $recharge;
    $user = $recharge['recharge_wallet']['user_recharge_wallet'];
    $type = 'Nạp tiền vào ví';
} elseif (isset($withdraw) && $withdraw != '') {
    $wallet = 2;
    $detail = $withdraw;
    $user = $withdraw['withdrawal_wallet']['user'];
    $type = 'Rút tiền từ ví';
} elseif (isset($reward) && $reward != '') {
    $wallet = 3;
    $detail = $reward;
    $user = $reward['reward_wallet']['user'];
    if ($detail['type'] == 1) {
        $type = 'Cộng thưởng';
    } else {
        $type = 'Rút tiền về ví tiền';
    }
}

?>
@extends('layouts.app')
@section('title-page', 'Chi tiết giao dịch')
@section('content')


<section class="content">
    <h2 class="text-center">Chi tiết giao dịch: {{ $type }}</h2>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table " boder="none">
                <tr>
                    <th class="col-md-3 col-6" style="width:20%">Họ tên:</th>
                    <td class="col-md-3 col-6">{{ $user['name'] }}</td>
                    <th class="col-md-3 col-6">Mã CTV</th>
                    <td class="col-md-3 col-6">{{ $user['code_branch'] }}-{{ $user['code_ordinal'] }}</td>
                </tr>
                <tr>
                    <th class="col-md-3 col-6">Số điện thoại:</th>
                    <td class="col-md-3 col-6">{{ $user['phone'] }}</td>
                    <th class="col-md-3 col-6">Email:</th>
                    <td class="col-md-3 col-6">{{ $user['email'] }}</td>

                </tr>

                <tr>
                    <th class="col-md-3 col-6">Loại:</th>
                    <td class="col-md-3 col-6">{{ $type }}</td>
                    <th class="col-md-3 col-6">Nội dung:</th>
                    <td class="col-md-3 col-6">{{ $detail['content'] }}</td>

                </tr>

                <tr>
                    <th class="col-md-3 col-6">Số tiền giao dịch:</th>
                    <td class="col-md-3 col-6">{{ number_format($detail['money']) }}</td>
                    @if ($wallet == 1 || $wallet == 2)
                        <th class="col-md-3 col-6">Ảnh giao dịch:</th>
                        <td class="col-md-3 col-6"><img src="{{ $detail['image'] }}" alt="" width=200px height="200px">
                        </td>

                </tr>
                    @php
                        if ($detail['status'] == 0) {
                            $status = 'Chờ xác nhận';
                        } elseif ($detail['status'] == 1) {
                            $status = 'Đã hoàn thành';
                        } elseif ($detail['status'] == 2) {
                            $status = 'Đã huỷ';
                        }
                    @endphp
                    <tr>
                        <th class="col-md-3 col-6">Tên ngân hàng:</th>
                        <td class="col-md-3 col-6">{{ $detail['bank_name'] }}</td>
                        <th class="col-md-3 col-6">Tên chi nhánh:</th>
                        <td class="col-md-3 col-6">{{ $detail['branch'] }}</td>

                    </tr>

                    <tr>
                        <th class="col-md-3 col-6">Số tài khoản:</th>
                        <td class="col-md-3 col-6">{{ $detail['account_stk'] }}</td>
                @elseif($wallet == 3)
                        @php
                            if ($detail['status'] == 1) {
                                $status = 'Chờ xác nhận';
                            } elseif ($detail['status'] == 2) {
                                $status = 'Đã hoàn thành';
                            } elseif ($detail['status'] == 3) {
                                $status = 'Đã huỷ';
                            }
                        @endphp
                @endif
                <th class="col-md-3 col-6">Trạng thái:</th>
                <td class="col-md-3 col-6">{{ $status }}</td>

                </tr>






            </table>
        </div>
    </div>
</section>
@endsection
