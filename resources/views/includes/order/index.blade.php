@php
$totalPage = $orders['total_page'];
$currentPage = $orders['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Danh sách đơn hàng')
@section('content')


    <section class="content">



        <div class="container-fluid">
            <h1 class="text-center leader-title">Danh sách đơn hàng</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ asset('don-hang/danh-sach/1/trang-thai=' . $status) }}" method="GET" id="formSearchData">
                                <div class="row d-flex align-items-end">
                                    <div class="col-12 col-md-2">
                                        <label>Mã đơn hàng</label>
                                        <div class="input-group">
                                            <input type="text" name="order_code" id="orderCode" value="{{$order_code}}" class="form-control" placeholder="Mã đơn hàng">
                                        </div>
                                        <!-- input-group -->
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label>Thanh toán</label>
                                        <div class="input-group">
                                            <select name="type_payment" id="" class="form-control">
                                                <option value="0">Tất cả</option>
                                                <option value="1" @if ($type_payment == 1)
                                                    {{ "selected"}}
                                                @endif>Tiền mặt</option>
                                                <option value="2" @if ($type_payment == 2)
                                                    {{ "selected"}}
                                                @endif>Chuyển khoản</option>
                                            </select>
                                        </div>
                                        <!-- input-group -->
                                    </div>

                                    <button class="btn btn-primary float-right ml-auto"
                                        style="height: 40px; float:right">Tìm kiếm</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"
                        style="font-size: 15px;">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Thông tin người đặt</th>
                                <th>Số tiền</th>
                                <th>Phí ship</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đặt</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                               
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($orders['data'] as $key => $item)

                                @php
                
                                    $date = date(' d-m-Y', strtotime($item['createdAt']));
                                    $statusOrder = '';
                                    if ($item['status'] == 0) {
                                        $statusOrder = 'Chưa đặt đơn';
                                    } elseif ($item['status'] == 1) {
                                        $statusOrder = 'Đã đặt đơn';
                                    } elseif ($item['status'] == 8) {
                                        $statusOrder = 'Đơn đã huỷ';
                                    } elseif ($item['status'] == 4) {
                                        $statusOrder = 'Đơn đang giao';
                                    } elseif ($item['status'] == 5) {
                                        $statusOrder = 'Đã hoàn thành';
                                    }
                                    $payment = '';
                                    if($item['type_payment'] == 0)  $payment = 'Tiền mặt';
                                    else if($item['type_payment'] == 1) $payment = 'Chuyển khoản';
                                @endphp
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item['order_code'] }}</td>
                                    <td>{{ $item['user']['name'] }}
                                        <br>
                                        {{ $item['user']['phone'] }}
                                    </td>
                                    <td>{{ number_format($item['total_money']) }} đ</td>
                                    <td>{{ number_format($item['fee_ship']) }} đ</td>
                                    <td>{{ $item['address'] }}
                                        <br>
                                        @if($item['note_address']!= null) Ghi chú: {{ $item['note_address'] }} @endif
                                    </td>

                                    <td>{{ $date }} </td>
                                    <td>{{ $payment}}</td>
                                    <td>{{ $statusOrder }}</td>
                                   
                                    <td class="text-center">

                                        <a href="" data-toggle="modal" data-target="#detail{{ $item['order_code'] }}"
                                            class="btn btn-info btn-circle btn-sm ">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                       
                                    </td>

                                    <!-- detail Modal-->
                                    <div class="modal fade bd-example-modal-lg" id="detail{{ $item['order_code'] }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng:
                                                        {{ $item['order_code'] }}</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{ asset('don-hang/cap-nhat/'.$item['order_code'])}}">
                                                @csrf
                                                    <div class="modal-body">
                                                   
                                                    <div class="row p-2">
                                                        <b class="col-3">Số lượng sản phẩm:</b>
                                                        <span class="col-3">{{ $item['total_count'] }}</span>
                                                        <b class="col-3">Số tiền:</b>
                                                        <span
                                                            class="col-3">{{ number_format($item['total_money']) }} đ</span>
                                                    </div>
                                                    <div class="row p-2">
                                                        <b class="col-3">Họ tên khách hàng:</b>
                                                        <span class="col-3">{{ $item['user']['name'] }}</span>
                                                        <b class="col-3">Số điện thoại:</b>
                                                        <span class="col-3">{{ $item['user']['phone'] }}</span>
                                                    </div>
                                                    <div class="row p-2">
                                                        <b class="col-3">Địa chỉ:</b>
                                                        <span class="col-3">{{ $item['address'] }}</span>
                                                        <b class="col-3">Ghi chú địa chỉ:</b>
                                                        <span class="col-3">{{ $item['note_address'] }}</span>
                                                    </div>
                                                    <div class="row p-2">
                                                        <b class="col-3">Phí ship:</b>
                                                        <span class="col-3">{{ number_format($item['fee_ship']) }} đ</span>
                                                        <b class="col-3">Trạng thái:</b>
                                                        @if($item['status'] == 0 ) <span class="col-3">{{ $status}}</span>
                                                        @else
                                                        <select name="status" id="" class="form-control col-3">
                                                            <option value="0" @if ($item['status'] == 0){{"selected"}}@endif>Chưa đặt đơn</option>
                                                            <option value="1" @if ($item['status'] == 1){{"selected"}}@endif>Đã đặt đơn</option>
                                                            <option value="4" @if ($item['status'] == 4){{"selected"}}@endif>Đang giao</option>
                                                            <option value="5" @if ($item['status'] == 5){{"selected"}}@endif>Đã hoàn thành</option>
                                                            <option value="8" @if ($item['status'] == 8){{"selected"}}@endif>Đã huỷ đơn</option>

                                                        </select>
                                                        @endif
                                                    </div>
                                                    <div class="row p-2">
                                                        <b class="col-3">Ghi chú món ăn:</b>
                                                        <span class="col-3">{{ $item['note_dish'] }}</span>
                                                        <b class="col-3">Sử dụng voucher:</b>
                                                        <span class="col-3">@if ($item['is_use_voucher'] == 0) {{"Không"}}
                                                            @else {{"Có"}}
                                                            
                                                        @endif</span>
                                                        
                                                    </div>
                                                    <div class="row p-2">
                                                        <b class="col-3">Ngày đặt hàng:</b>
                                                        <span class="col-3">{{ $date }}</span>
                                                        <b class="col-3">Thanh toán:</b>
                                                        <span class="col-3">@if ($item['type_payment'] == 0) {{"Tiền mặt"}}
                                                            @else {{"Ngân hàng"}}
                                                            
                                                        @endif</span>
                                                        
                                                    </div>
                                                    <div class="row p-2">
                                                        <b class="col-3">Dụng cụ ăn uống:</b>
                                                        <span class="col-3">@if ($item['kitchen_tool'] == 0) {{"Không"}}
                                                            @else {{"Có"}}
                                                            
                                                        @endif</span>
                                                       
                                                    </div>
                                                    @if (isset($item['image_payment']) && $item['image_payment'] != null)
                                                    <div class="row p-2">
                                                    <b class="col-3">Ảnh thanh toán:</b>
                                                    @foreach ($item['image_payment'] as $image)
                                                <div>
                                                    <a href="{{ $image['image']}}" data-lightbox="photos">
                                                    <img src="{{$image['image']}}" alt="" class="p-2" style="max-width: 100px; max-height: 100px;">
                                                    </a>
                                                </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" 
                                                        data-dismiss="modal">Đóng</a>
                                                        <button type="submit" class="btn btn-primary">Lưu</a>

                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ---------------- --}}
                                </tr>


                            @endforeach
                   <tr>
                                <td colspan="9" class="text-center" boder:none>
                                    {{-- ======= phân trang ======== --}}
                                   
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item"><a class="page-link"
                                                href="{{ asset('don-hang/danh-sach/1/trang-thai='. $status) }}">Đầu</a>
                                        </li>

                                        @if ($currentPage - 1 >= 1)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('don-hang/danh-sach/' . ($currentPage - 1) .'/trang-thai=' .$status) }}">
                                                    <i class="fas fa-angle-left"></i></a></li>
                                        @endif
                                        @if ($currentPage - 1 >= 1)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('don-hang/danh-sach/' . ($currentPage - 1) .'/trang-thai='.$status) }}">{{ $currentPage - 1 }}</a>
                                            </li>
                                        @endif
                                        <li class="page-item {{ 'active' }}"><a class="page-link"
                                                href="{{ asset('don-hang/danh-sach/' . $currentPage .'/trang-thai='.$status) }}">{{ $currentPage }}</a>
                                        </li>
                                        @if ($currentPage + 1 <= $totalPage)
                                            <li class="page-item "><a class="page-link"
                                                    href="{{ asset('don-hang/danh-sach/' . ($currentPage + 1) .'/trang-thai='.$status) }}">{{ $currentPage + 1 }}</a>
                                            </li>
                                        @endif
                                        {{-- @endfor --}}
                                        @if ($currentPage + 1 <= $totalPage)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('don-hang/danh-sach/' . ($currentPage + 1) .'/trang-thai='.$status) }}">
                                                    <i class="fas fa-angle-right"></i></a></li>
                                        @endif
                                        <li class="page-item"><a class="page-link"
                                                href="{{ asset('don-hang/danh-sach/' . $totalPage .'/trang-thai='.$status) }}">Cuối</a>
                                        </li>
                                    </ul>
                                    {{-- ==========hết phân trang ============ --}}
                                </td>
                            </tr>

                        </tbody>

                    </table>


                </div>
            </div>
          </div>
        </div>

        </div>
        </div>

    </section>


@endsection
