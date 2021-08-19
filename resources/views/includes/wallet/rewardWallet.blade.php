<?php
$token = Cookie::get('token');
$currentPage = $reward['reward_wallet']['current_page'];
$totalPage = $reward['reward_wallet']['last_page'];
?>
@extends('layouts.app') @section('title-page', 'Ví thưởng') @section('content')


<section class="content">


    <div class="container">

        <h1 class="text-center leader-title">Lịch sử giao dịch ví thưởng:</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <p>Tên: {{number_format($revenue['total_money_ctv'])}} VNĐ <br> --}} {{-- Tổng tiền: {{$revenue['quantity_ctv']}}</p> --}}
                <b>
                    <p>Họ tên: {{ $reward['total']['user']['name'] }}</p>
                    <p>Tổng tiền: {{ number_format($reward['total']['total_money']) }} VNĐ
                </b>

                </p>

                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                    action="">
                    <div class="input-group">
                        <label for="" style="margin-left:10px; padding-right:5px;">Trạng thái:</label>
                        <select name="status" id="" class="form-control">
                            <option value="1">Chờ xác nhận</option>
                            <option value="2">Đã xác nhận</option>
                            <option value="3">Đã huỷ</option>
                        </select>

                        <label for="" style="margin-left:10px; padding-right:5px;">Từ ngày:</label>
                        <input type="date" name="from_date" class="form-control  border-1 small"
                            value="<?php if (isset($_GET['from_date'])) {
                                echo $_GET['from_date'];
                            } ?>">
                        <label for="" style="margin-left:10px;padding-right:5px;">Đến ngày:</label>
                        <input type="date" name="to_date" class="form-control  border-1 small"
                            value="<?php if (isset($_GET['to_date'])) {
                                echo $_GET['to_date'];
                            } ?>">
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
                    <div class="text-right mb-1"><a data-toggle="modal" data-target="#reward" class="btn btn-info">Rút
                            tiền</a>
                    </div>
                    <div class="modal fade" id="reward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <div class="">
                                                <div class="modal-header">
                                                    <h1 class="h4 text-gray-900 mb-4">Bạn có muốn rút tiền thưởng về ví?
                                                    </h1>
                                                </div>
                                                <form action="{{ route('rewardToWallet') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <label for="" class="text-left">Số tiền</label>
                                                        <input type="number" class="form-control" value="" name="money">
                                                        <label for="">Nội dung</label>
                                                        <input type="text" class="form-control" value=""
                                                            placeholder="Rút tiền về ví ...." name="content">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Không</button>
                                                        <button type="submit" class="btn btn-primary">Có</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="dataTable" class="container tab-pane active">
                            <table class="table table-bordered" width="100%" cellspacing="0" style="font-size: 15px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên tài khoản yêu cầu</th>
                                        <th>Loại</th>
                                        <th>Số tiền</th>

                                        <th>Nội dung</th>
                                        {{-- <th>Nội dung</th> --}}
                                        <th>Trạng thái</th>
                                        <th style="width: 80px;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($reward['reward_wallet']['data']) && $reward['reward_wallet']['data'] != null) { ?> @foreach ($reward['reward_wallet']['data'] as $index => $item)
                                        @php
                                            if ($item['status'] == 2) {
                                                $status = 'Đã hoàn thành';
                                            } elseif ($item['status'] == 1) {
                                                $status = 'Chờ xác nhận';
                                            } elseif ($item['status'] == 3) {
                                                $status = 'Đã huỷ';
                                            }
                                            if ($item['type'] == 1) {
                                                $type = 'Cộng thưởng';
                                            } elseif ($item['type'] == 2) {
                                                $type = 'Rút tiền về ví';
                                        } @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item['account_name'] }}</td>
                                            <td>{{ $type }}</td>
                                            <td>{{ number_format($item['money']) }} VNĐ</td>
                                            <td>{{ $item['content'] }} </td>
                                            <td>{{ $status }}</td>

                                            {{-- <td>{!! $item['content'] !!} </td> --}} {{-- <td>{!! $status !!}</td> --}}


                                            <td>
                                                <a
                                                    href="{{ asset('chi-tiet-giao-dich/vi-thuong/id=' . $item['id']) }}">
                                                    <i class="fas fa-eye" style="cursor: pointer;"></i>
                                                </a>

                                            </td>
                                        </tr>


                                    @endforeach
                                    <?php } else {echo 'dữ liệu trống!';} ?>



                            </table>
                            </tbody>
                         {{-- ======= phân trang ======== --}}
                         <ul class="pagination justify-content-end">
                            <li class="page-item"><a class="page-link" href="{{ asset('vi-thuong/1') }}">Đầu</a>
                            </li>

                            @if (($currentPage - 1) >= 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ asset('vi-thuong/' . ($currentPage - 1)) }}">
                                        <i class="fas fa-angle-left"></i></a>
                                </li>
                                @endif @if (($currentPage - 1) >= 1)
                                    <li class="page-item"><a class="page-link"
                                            href="{{ asset('vi-thuong/' . ($currentPage - 1)) }}">{{ ($currentPage - 1) }}</a>
                                    </li>
                                @endif
                                <li class="page-item {{ 'active' }}"><a class="page-link"
                                        href="{{ asset('vi-thuong/' . $currentPage) }}">{{ $currentPage }}</a>
                                </li>
                                @if (($currentPage + 1) <= $totalPage)
                                    <li class="page-item "><a class="page-link"
                                            href="{{ asset('vi-thuong/' . ($currentPage + 1)) }}">{{ ($currentPage + 1) }}</a>
                                    </li>
                                    @endif {{-- @endfor --}} @if (($currentPage + 1) <= $totalPage)
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ asset('vi-thuong/' . ($currentPage + 1)) }}"> <i
                                                    class="fas fa-angle-right"></i></a>
                                        </li>
                                    @endif
                                    <li class="page-item"><a class="page-link"
                                            href="{{ asset('vi-thuong/' . $totalPage) }}">Cuối</a></li>
                        </ul>
                        {{-- ==========hết phân trang ============ --}}
                        </div>

                    </div>
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
