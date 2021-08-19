@extends('layouts.app')
@section('title-page', 'Chi tiết sản phẩm')
@section('content')


    <section class="content">



        <div class="container">
            <h2 class="text-center leader-title">Chi tiết sản phẩm: {!! $detailProduct['name'] !!}</h2>
            <div class="card shadow m-4">
                <div class="card-body row">
                    <div class="col-md-4">
                        <img src="{{ $detailProduct['image'] }}" alt=""
                            style="height: 400px; width:320px; object-fit:contain">
                        <div class="text-center pb-3">

                            <a href="{{ asset('them-gio-hang/' . $detailProduct['id']) }}">
                                <button class="btn btn-info"> Thêm giỏ hàng + </button>
                            </a>
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
            <h2 class="text-center">Sản phẩm liên quan:</h2>
            <div class="row mb-4" id="document">

                @foreach ($detailProduct['related_product'] as $item)

                    @php
                        
                        $id = $item['product']['id'];
                    @endphp
                    <div class="col-lg-4 clo-md-4">
                        <div class="card border-left-primary shadow text-center py-2 " style="margin:15px 10px;">
                            <a href="{{ asset('chi-tiet-san-pham/id=' . $id) }}" class="image_hover"><img
                                    src="{{ $item['product']['image'] }}" alt="" style="height: 210px;
                                                width: 160px; object-fit:contain; transition: width 2s, height 2s"
                                    class="mt-1 "></a>
                            <div>
                                <a href="{{ asset('chi-tiet-san-pham/id=' . $id) }}">
                                    <p style="padding-top: 10px; font-weight: bold; color:#000;">
                                        {!! $item['product']['name'] !!}</p>

                                </a>
                                <div class="text-center">
                                    <p>Giá:
                                        @if ($item['product']['price_sale'] == null)
                                            <b>{{ number_format($item['product']['price']) }} đ</b>

                                        @else <strike>{{ number_format($item['product']['price']) }} đ </strike>
                                            <b> {{ number_format($item['product']['price_sale']) }} đ </b>
                                        @endif
                                    </p>
                                </div>
                                <div class="text-center pb-3">
                                    <a href="{{ asset('them-gio-hang/' . $id) }}">
                                        <i class="fas fa-cart-plus fa-2x"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>


    @endsection
