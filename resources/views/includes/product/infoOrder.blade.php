@extends('layouts.app')
@section('title-page', 'Danh sách sản phẩm')
@section('content')
            <section class="content">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Thông tin đơn hàng: </h1>
                                </div>
                                <form class="user card p-3" method="post" action="{{route('them-don-hang')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Họ và tên</label>
                                        <input type="text" class="form-control form-control-user" id="" name="name_user" value="{{$infor['name']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control form-control-user" id="" name="phone_order" value="{{$infor['phone']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ</label>
                                        <input type="text" class="form-control form-control-user" value="{{$infor['address']}}" name="address_order">
                                    </div>
                                    @php
                                         $stt = $infor['code_branch']."-".$infor['code_ordinal'];
                                    @endphp
                                    <div class="form-group">
                                        <label for="">Mã CTV</label>
                                        <input type="text" class="form-control form-control-user" id="" value="{{$stt}}" readonly name="code_ctv">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tổng sản phẩm:</label>
                                        <input type="number" readonly value="{{$infor['cart_total_product']}}" class="form-control form-control-user"
                                             name="total_product">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tổng số tiền:</label>
                                        <input type="text" readonly value="{{number_format($infor['cart_total_money'])}}" class="form-control form-control-user" id="money-fee"
                                             name="total_money_product">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nội dung mua</label>
                                        <textarea name="content" id="" rows="5" class="form-control " placeholder="Nội dung mua"></textarea>
                                    </div>
                                
                                    <div class="text-center">
                                        <a href="" class="btn btn-info btn-user " style="width:25%;" data-toggle="modal" data-target="#OrderModal">
                                            Đặt mua
                                        </a>
                                    </div>
                                    <div class="modal fade" id="OrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Nội dung chuyển tiền:</label>
                                                    <input type="text" class="form-control form-control-user" id="" name="content_payment" value="Chuyen tien mua sua {{$stt}}" readonly>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Thông tin tài khoản: </label>
                                                    <input type="text" class="form-control form-control-user" id="" name="content_payment" value="Số tài khoản: 19034313877011, Techcombank  - Nguyễn Hà Trang" readonly>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                                    <button style="background: #fff;border: none;" type="submit"><a class="btn btn-info">Gửi</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            @endsection
<script>
    $("#money-fee").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            if (!isNaN(n)) $(this).val(n.toLocaleString());
            else $(this).val();
        });
</script>
</html>
