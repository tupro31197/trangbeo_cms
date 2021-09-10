
@extends('layouts.app')
@section('title-page', 'Chi tiết đơn hàng')
@section('after-css')
    <link rel="stylesheet" href="{{ asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')


    <section class="content">



        <div class="container">
            <h1 class="text-center leader-title">Chi tiết đơn hàng: </h1>
            <div class="card shadow mb-4">

                <div class="card-body">
                    <form method="post" action="{{ route('order.updateOrder', ['code' => $detail['order_code']])}}">
                        @csrf
                    <table class="table">
                        <tr class="row">
                            <th class="col-md-3 col-3">Mã đơn hàng</th>
                            <td class="col-md-9 col-9" rowspan="3"> {{ $detail['order_code'] }}</td>

                        </tr>
                        <tr class="row">
                            <th class="col-md-3 col-3">Món ăn</th>
                            <td class="col-md-9 col-9" rowspan="3">
                               
                                   <table>
                                       <tr>
                                           <th>Tên</th>
                                           <th>Số lượng</th>
                                           <th>Topping</th>
                                       </tr>
                                       <tr>
                                        @foreach ($detail['book_dish'] as $key=>$item)
                                            <td>{{ $item['dish']['name']}}</td>
                                            <td>{{ $item['count']}}</td>
                                            <td>
                                                @foreach ($item['book_topping'] as $item2)
                                                    {{$item2['topping_dish']['name']}} : {{ number_format($item2['money_topping'])}}
                                            <br>
                                                    @endforeach
                                            </td>
                                        @endforeach
                                       </tr>
                                   </table>
                             
                            </td>

                        </tr>

                        <tr class="row">
                            <th class="col-md-3 col-3 ">Ghi chú món ăn: </th>
                            <td class="col-md-3 col-9"> {{ $detail['note_dish'] }}</td>
                            <th class="col-md-2 col-3 ">Voucher: </th>
                            <td class="col-md-4 col-9"> 
                                @if ($detail['is_use_voucher'] == 0) {{"Không"}}
                                                            @else {{"Có"}}
                                                            
                                                        @endif
                            </td>
                        </tr>

                        <tr class="row">
                            <th class="col-md-3 col-3">Ngày đặt hàng</th>
                            <td class="col-md-3 col-9"> {{ date(' d-m-Y', strtotime($detail['createdAt'])) }}</td>
                            <th class="col-md-2 col-3">Thanh toán:</th>
                            <td class="col-md-4 col-9"> @if ($detail['type_payment'] == 0) {{"Tiền mặt"}}
                                @else {{"Ngân hàng"}}
                                
                            @endif</td>

                        </tr>

                        <tr class="row">
                            <th class="col-md-3 col-3">Dụng cụ ăn uống</th>
                            <td class="col-md-3 col-9"> @if ($detail['kitchen_tool'] == 0) {{"Không"}}
                                @else {{"Có"}}
                                
                            @endif</td>
                            <th class="col-md-2 col-3">Ảnh thanh toán (nếu có):</th>
                            <td class="col-md-4 col-9">
                                @foreach ($detail['image_payment'] as $image)
                                <a href="{{ $image['image']}}" data-lightbox="photos">
                                    <img src="{{$image['image']}}" alt="" class="p-2" style="max-width: 100px; max-height: 100px;">
                                    @endforeach
                            </td>

                        </tr>

                        <tr class="row">
                            <th class="col-md-3 col-3">Tổng số lượng</th>
                            <td class="col-md-3 col-9"> {{ $detail['total_count'] }}</td>
                            <th class="col-md-2 col-3">Tổng tiền:</th>
                            <td class="col-md-4 col-9"> {{ number_format($detail['total_money']) }} đ</td>

                        </tr>
                      

                        <tr class="row">
                            <th class="col-md-3 col-3 ">Tên khách hàng: </th>
                            <td class="col-md-3 col-9"> {{ $detail['user']['name'] }}</td>
                            <th class="col-md-2 col-3 ">Địa chỉ: </th>
                            <td class="col-md-4 col-9"> {{ $detail['address'] }}</td>
                        </tr>
                      
                        <tr class="row">
                            <th class="col-md-3 col-3 ">Số điện thoại: </th>
                            <td class="col-md-3 col-9">{{ $detail['user']['phone'] }}</td>
                            <th class="col-md-2 col-3 ">Phí ship: </th>
                            <td class="col-md-4 col-9"> {{ number_format($detail['fee_ship'])}} đ
                            </td>
                        </tr>
                        <tr class="row">
                           
                        </tr>
                        
                        <tr class="row">
                            <th class="col-md-3 col-3 ">Trạng thái: </th>
                            <td class="col-md-9 col-9" rowspan="3"> 
                                @if($detail['status'] == 0 ){{ 'Chờ đặt đơn'}}</span>
                                @else
                                <select name="status" id="" class="form-control">
                                    @if($detail['status'] == 1)
                                    <option value="1" @if ($detail['status'] == 1){{"selected"}}@endif>Đã đặt đơn</option>
                                   @endif

                                    @if(in_array($detail['status'], [1,9]))
                                    <option value="9" @if ($detail['status'] == 9){{"selected"}}@endif>Đã xác nhận</option>
                                    @endif
                                    @if(in_array($detail['status'], [4,9]))
                                    <option value="4" @if ($detail['status'] == 4){{"selected"}}@endif>Đang giao</option>
                                    @endif
                                    @if(in_array($detail['status'], [4,5]))
                                    <option value="5" @if ($detail['status'] == 5){{"selected"}}@endif>Đã hoàn thành</option>
                                    @endif
                                    @if(in_array($detail['status'], [1,8,9,4]))
                                    <option value="8" @if ($detail['status'] == 8){{"selected"}}@endif>Đã huỷ đơn</option>
                                    @endif
                                 

                                </select>
                                @endif
                            </td>
                        </tr>


                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                        <a href="{{ route('order.print', ['code' => $detail['order_code']])}}"
                            class="btn btn-warning text-white">Xuất hoá đơn</a>
                    </div>
                    </form>

                </div>
            </div>

        </div>
        </div>
    </section>
@endsection



<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('layout/libjs')

</body>

</html>
