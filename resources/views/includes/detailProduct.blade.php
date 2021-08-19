@extends('layouts.appkh')
@section('title-page', 'Chi tiết sản phẩm')
@section('content')


    <section class="content">


        @if(isset($response))
            @php
                $data = $response['data'];
                // dd($data);
            @endphp
            <h2 class="text-center">Đặt hàng thành công!</h2>
            <div class="card shadow container p-5">

                <div >
                    <label for="name">Họ tên người mua:</label>
                    <input type="text" name="name_user" class="form-control" value="@if(isset($data['name_user'])) {{ $data['name_user']}} @endif" readonly>
                </div>
                <div >
                    <label for="name">SĐT người mua:</label>
                    <input type="text" name="phone_order" class="form-control" value="@if(isset($data['phone_order'])) {{ $data['phone_order']}} @endif" readonly>
                </div>
                <div >
                    <label for="name">Địa chỉ người mua:</label>
                    <input type="text" name="address_order" class="form-control" value="@if(isset($data['address_order'])) {{ $data['address_order']}} @endif" readonly>
                </div>
                <div >
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" name="" value="{{ $detailProduct['name']}}" class="form-control" readonly>
                    <input type="text" name="product_id" value="{{ $detailProduct['id']}}" class="form-control" readonly hidden>
                   
                </div>
                <div >
                    <label for="name">Số lượng mua:</label>
                    <input type="number" name="number" class="form-control" value="@if(isset($data['total_product'])) {{ $data['total_product']}} @endif" readonly>
                </div>
                <div >
                    <label for="name">Tổng tiền:</label>
                    <input type="text" name="number" class="form-control" value="@if(isset($data['total_money_product'])) {{ number_format($data['total_money_product']) }} @endif" readonly>
                </div>
                <div >
                    <label for="name">Nội dung mua:</label>
                    <textarea cols="10" rows="5" type="text" name="content" class="form-control" readonly>@if(isset($data['content'])) {{ $data['content']}} @endif</textarea>
                </div>
               

            </div>
        @else
        <div class="container">
            <h2 class="text-center leader-title">Chi tiết sản phẩm: {!! $detailProduct['name'] !!}</h2>
            <div class="card shadow m-4">
                <div class="card-body row">
                    <div class="col-md-4">
                        <img src="{{ $detailProduct['image'] }}" alt=""
                            style="height: 400px; width:320px; object-fit:contain">
                        <div class="text-center pb-3">

                            {{-- <a href="{{ asset('them-gio-hang/' . $detailProduct['id']) }}">
                                <button class="btn btn-info"> Thêm giỏ hàng + </button>
                            </a> --}}
                        </div>
                    </div>
                    <div class="col-md-8 p-5">
                        <table class="table">
                            <tr>
                                <th>Tên sản phẩm: </th>
                                <td><i>{!! $detailProduct['name'] !!}</i></td>
                            </tr>
                            <tr>
                                <th>Giá sản phẩm</th>
                                <td><i>{{ number_format($detailProduct['price']) }} VNĐ</i></td>

                            </tr>
                            @if (isset($detailProduct['price_sale']) && $detailProduct['price_sale'] != null)
                                <tr>
                                    <th>Giá khuyến mãi</th>
                                    <td><i>{{ number_format($detailProduct['price_sale']) }} VNĐ</i></td>

                                </tr>
                            @endif

                            <tr>
                                <th>Mô tả sản phẩm</th>
                                <td>{!! $detailProduct['description'] !!}</td>

                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <h2 class="text-center">Thông tin đặt hàng:</h2>
            <div class="card shadow container p-5">

              <form action="{{ asset('dat-hang')}}" method="post">
                @csrf
                <div >
                    <label for="name">Họ tên người mua:</label>
                    <input type="text" name="name_user" class="form-control">
                </div>
                <div >
                    <label for="name">SĐT người mua:</label>
                    <input type="text" name="phone_order" class="form-control">
                </div>
                <div >
                    <label for="name">Địa chỉ người mua:</label>
                    <input type="text" name="address_order" class="form-control">
                </div>
                <div >
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" name="" value="{{ $detailProduct['name']}}" class="form-control" readonly>
                    <input type="text" name="product_id" value="{{ $detailProduct['id']}}" class="form-control" readonly hidden>
                    <input type="text" name="cmt" value="{{ $cmt}}" class="form-control" readonly hidden>
                </div>
                <div >
                    <label for="name">Số lượng mua:</label>
                    <input type="number" name="number" class="form-control">
                </div>
                <div >
                    <label for="name">Nội dung mua:</label>
                    <textarea cols="10" rows="5" type="text" name="content" class="form-control"></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </div>
            </form>

            </div>
        </div>

        @endif
    @endsection
