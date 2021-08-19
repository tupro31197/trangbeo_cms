@php

$ctv = $detail['user'];
$detailOrder = $detail['detail_order'];
$ctv_id = $ctv['code_branch'] . '-' . $ctv['code_ordinal'];
$date = date(' d-m-Y', strtotime($detail['created_at']));
@endphp
@extends('layouts.app')
@section('title-page', 'Danh sách sản phẩm')
@section('content')


            <section class="content">


                <div class="container">
                    <h1 class="text-center leader-title">Chi tiết đơn hàng: </h1>
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                        style="font-size: 15px;">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">Mã CTV</th>
                                                <th>{{ $ctv_id}}</th>

                                            </tr>
                                            <tr>
                                                <th>Họ tên người mua</th>
                                                <th>{{ $detail['name_user'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>SĐT người mua</th>
                                                <th>{{ $detail['phone_order'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>Địa chỉ người mua</th>
                                                <th>{{ $detail['address_order'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>Tổng sản phẩm</th>
                                                <th>{!! $detail['total_product'] !!} <br>
                                                    <a data-toggle="modal" data-target="#detail"
                                                       style="text-decoration: underline;
                                                       color: #4e73df;">
                                                        Chi tiết...
                                                    </a>
                                                      {{-- =========== modal chi tiet =============== --}}
                                            <div class="modal fade" id="detail" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Danh sách sản
                                                            phẩm: </h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên sản phẩm</th>
                                                                <th>Giá</th>
                                                                <th>Số lượng mua</th>
                                                            </tr>
                                                            @foreach ($detailOrder as $index => $item)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $item['product_name'] }}</td>
                                                                    <td>{{ number_format($item['price']) }} đ</td>
                                                                    <td>{{ $item['number'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Đóng</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ================================= --}}

                                                </th>

                                            </tr>
                                          
                                            <tr>
                                                <th>Tổng giá tiền</th>
                                                <th>
                                                    {{ number_format($detail['total_money_product']) }} đ
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>Tiền ship</th>
                                                <th class="form-group">
                                                   {{ $detail['ship'] }}
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>Trạng thái đơn hàng:</th>
                                                <th class="form-group">
                                                    @php
                                                     if($detail['status']==1) echo 'Chờ xác nhận';
                                                     else if($detail['status']==2) echo 'Đang giao hàng';
                                                     else if($detail['status']==3) echo 'Đã giao hàng';
                                                     else if($detail['status']==4) echo 'Đã huỷ';
                                                  @endphp
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>Thời gian mua</th>
                                                <th>{{ $date }}</th>

                                            </tr>
                                            <tr>
                                                <th>Nội dung mua</th>
                                                <th>{{ $detail['content'] }}</th>

                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-center"><button class="btn btn-primary"
                                                        type="submit">Cập nhật</button>
                                                </th>

                                            </tr>
                                        </thead>

                                    </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include('layout/footer')
        @endsection



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  
