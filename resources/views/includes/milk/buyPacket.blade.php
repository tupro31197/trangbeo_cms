@php
// dd($buy);
$totalPage = $buy['list_buy_packet']['last_page'];
$currentPage = $buy['list_buy_packet']['current_page'];

@endphp

@extends('layouts.app')
@section('title-page', 'Đơn hàng sản phẩm')
@section('content')


    <section class="content">

                <div class="container">
                    <h1 class="text-center leader-title">Danh sách các gói mua</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                                
                            <p>Tổng tiền đã mua các gói: {{number_format($buy['total_money'])}} VNĐ
                                </p>
                            <p>Tên CTV: {{$buy['user']['name']}}</p>
                            <p>Tên định danh: {{$buy['user']['identifier_name']}}</p>
                            {{-- <p>Cổ phần: {{$buy['user']['share_number']}}</p>
                            <p>Số tiền thưởng: {{number_format($buy['user']['identifier_money'])}} VNĐ</p> --}}
                            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="">
                                <div class="input-group">
                                    <label for="" style="margin-left:10px;">Trạng thái</label>
                                    <select name="status" id="" class="form-control  border-1 small" style="width: 180px;">
                                        <option >-Chọn trạng thái-</option>
                                        <option value="1"@if (isset($_GET['status']) && $_GET['status']==1) selected @endif>Chờ xác nhận</option>
                                        <option value="2"@if (isset($_GET['status']) && $_GET['status']==2) selected @endif>Đã xác nhận</option>
                                        <option value="3"@if (isset($_GET['status']) && $_GET['status']==3) selected @endif>Đã hoàn thành</option>
                                        <option value="4"@if (isset($_GET['status']) && $_GET['status']==4) selected @endif>Đã hủy</option>
                                    </select>
                                        <label for="" style="margin-left:10px;">Từ ngày</label>
                                    <input type="date" name="form_date" class="form-control  border-1 small" style="width: 180px;" value="<?php if(isset($_GET['form_date']))  echo $_GET['form_date'];?>">
                                        <label for="" style="margin-left:10px;">Đến ngày</label>
                                    <input type="date" name="to_date" class="form-control  border-1 small" style="width: 180px;" value="<?php if(isset($_GET['to_date']))  echo $_GET['to_date'];?>">
                                    <div class="input-group-append" style="margin-left:10px;">
                                        <button class="btn btn-primary" type="submit" style="    border-top-left-radius: 5px;
                                        border-bottom-left-radius: 5px;">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                    <div class="text-right ml-2"><a href="{{asset('excel-packet')}}" class="btn btn-info">Xuất excel</a></div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Tên gói</th>
                                            <th>Ảnh</th>
                                            <th>Giá</th>
                                            <th>Thời gian mua</th>
                                            <th>Địa chỉ</th>
                                            <th>Điện thoại</th>
                                            <th>Nội dung mua</th>
                                            <th style="width: 70px;">Mã</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <?php $dem =1; ?>
                                    <tbody>
                                        <?php if (isset($buy) && $buy != null) { ?>
                                        @foreach ($buy['list_buy_packet']['data'] as $item)
                                            @php
                                                $date = date(' d-m-Y', strtotime($item['created_at']));
                                                $time = date(' H:i', strtotime($item['created_at']));
                                                $id = $item['id'];
                                                if ($item['status'] == 1) {
                                                    $status = 'Chờ xác nhận';
                                                    $none = '';
                                                }
                                                if($item['status'] == 2) {
                                                    $status = 'Đã xác nhận';
                                                    $none = 'None';
                                                }
                                                if($item['status'] == 3) {
                                                    $status = 'Đã hoàn thành';
                                                    $none = 'None';
                                                }
                                                if($item['status'] == 4) {
                                                    $status = 'Đã hủy';
                                                    $none = 'None';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $item['packet']['name'] }}</td>
                                                <td><img src="{{ $item['packet']['image'] }}" alt=""
                                                        style="height: 100px;"></td>
                                                <td>{{ number_format($item['price']) }} VNĐ</td>
                                                <td>{{ $date }}<br>{{ $time }}</td>
                                                <td>{!! $item['address'] !!}</td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td>
                                                    <p class="content-buy-packet">{!! $item['content'] !!}</p>
                                                </td>
                                                <td>{{ $item['code_ctv'] }}</td>
                                                <td>{{ $status }}</td>
                                                <td>
                                                    <a href="{{ asset('chi-tiet-goi-mua/id=' . $id) }}"><i
                                                            class="fas fa-eye" style="cursor: pointer;"></i></a>
                                                    <a data-toggle="modal" data-target="#deleteModal{{$dem}}">
                                                        <i class="far fa-trash-alt {{ $none }}"
                                                            style="cursor: pointer; padding-left:10px;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="deleteModal{{$dem}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="p-5">
                                                                <div class="text-center">
                                                                    <h1 class="h4 text-gray-900 mb-4">Bạn có muốn hủy gói
                                                                        mua này không?</h1>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Không</button>
                                                                        <button type="submit" class="btn btn-primary"><a
                                                                                href="{{ asset('huy-goi-mua/id=' . $id) }}"
                                                                                style="color: #fff;">Có</a></button>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
    
                                            </div>
                                        </div>
                                        @endforeach
                                        <?php } else {echo 'dữ liệu trống!';} ?>

                                        <ul class="pagination justify-content-end">
                                            <li class="page-item"><a class="page-link" href="{{ asset('danh-sach-san-pham/1') }}">Đầu</a>
                                            </li>
                    
                                            @if ($currentPage - 1 >= 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('danh-sach-san-pham/' . ($currentPage - 1)) }}"> <i
                                                            class="fas fa-angle-left"></i></a></li>
                                            @endif
                                            @if ($currentPage - 1 >= 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('danh-sach-san-pham/' . ($currentPage - 1)) }}">{{ ($currentPage - 1 )}}</a>
                                                </li>
                                            @endif
                                            <li class="page-item {{ 'active' }}"><a class="page-link"
                                                    href="{{ asset('danh-sach-san-pham/' . $currentPage) }}">{{ $currentPage }}</a>
                                            </li>
                                            @if ($currentPage + 1 <= $totalPage)
                                                <li class="page-item "><a class="page-link"
                                                        href="{{ asset('danh-sach-san-pham/' . ($currentPage + 1)) }}">{{ $currentPage + 1 }}</a>
                                                </li>
                                            @endif
                                            {{-- @endfor --}}
                                            @if ($currentPage + 1 <= $totalPage)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('danh-sach-san-pham/' . ($currentPage + 1)) }}"> <i
                                                            class="fas fa-angle-right"></i></a></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('danh-sach-san-pham/' . $totalPage) }}">Cuối</a></li>
                                        </ul>
                                    </tbody>

                                   
                                </table>
                               

                            </div>
                        </div>
                    </div>

                </div>
            </section>
            @endsection

