@extends('layouts.app')
@section('title-page', 'Chi tiết sản phẩm')
@section('content')


    <section class="content">

        <div class="container">
            <h1 class="text-left leader-title">Giỏ hàng:</h1>
            @foreach ($cart['cart']['data'] as $index => $item)
                <div class="card shadow mb-4">

                    <div class="card-body row">
                        <div class="col-md-1" style="display: flex; align-items:center">{{ $index + 1 }}</div>
                        <div class="col-md-3"><img src="{{ $item['product']['image'] }}" alt=""
                                style="max-width:200px; max-height:100px"></div>
                        <div class="col-md-2" style="display: flex; align-items:center">{{ $item['product']['name'] }}
                        </div>
                        <div class="col-md-1" style="display: flex;
                               align-items: center;"><input min="1" type="number"
                                onchange="updateCart({{ $item['product']['id'] }})" id="qtt{{$item['product']['id']}}" class="form-control"
                                value="{{ $item['number'] }}"></div>
                        <div class="col-md-2" style="display: flex; align-items:center">
                            {{ number_format($item['price']) }}đ
                        </div>
                        <div class="col-md-2" style="display: flex; align-items:center" id="total{{$item['product']['id']}}">
                            {{ number_format($item['price'] * $item['number']) }} đ</div>
                        <div class="col-md-1" style="display: flex; align-items: center">
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#delete<?php echo $item['id']; ?>">
                                <i class="fa fa-trash"></i>
                            </button>
                            <div class="modal fade" id="delete{{ $item['id'] }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="p-5">
                                                    <div class="text-center">
                                                        <h1 class="h4 text-gray-900 mb-4">Bạn có muốn xoá sản phẩm khỏi giỏ
                                                            hàng?</h1>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Không</button>
                                                            <button type="submit" class="btn btn-primary"><a
                                                                    href="{{ asset('xoa-gio-hang/' . $item['product_id']) }}"
                                                                    style="color: #fff;">Có</a></button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

            <div class="card shadow w-50 text-left p-3 m-2" style="font-size: 20px; float:right">
                <table boder="none">
                    <tr class="mt-5">
                        <th>Tổng sản phẩm:</th>
                        <th ><div id="total_product">{{ $cart['total_number'] }}</div> </th>
                    </tr>
                    <tr class="mt-5">
                        <th>Tổng tiền:</th>
                        <th><div id="total_money_product">{{ number_format($cart['total_money']) }} đ</div></th>
                    </tr>
                    <tr class="mt-5">

                        <th colspan="2" class="text-center">
                            <a class="btn btn-primary" href="{{ asset('thong-tin-dat-hang') }}">Đặt hàng</a>
                        </th>
                    </tr>
                </table>


            </div>

        </div>

    </section>
@endsection
<script>
    function updateCart(id) {
     
        var qty = $("#qtt" + id).val();
        
        if (qty > 0) {
            $.ajax({
                url: '{{route("updateCart")}}',
                type: 'get',
                dataType: 'html',
                data: {
                    id: id,
                    qty: qty
                },

                success: function(data) {
                    data = JSON.parse(data);
                 
                    var dollarUSLocale = Intl.NumberFormat('en-US');
                    var money = dollarUSLocale.format(data['product']) + ' đ';
                    $("#total" + id).html(money);
                    $('#total_product').html(data['total_product']);
                    var total_money_product = dollarUSLocale.format(data['total_money_product']) + ' đ';
                    $('#total_money_product').html(total_money_product);
                },

                error: function() {
                    console.log('error');
                }

            })
        } else {

        }

    }
</script>
