@php
$totalPage = $listOrder['last_page'];
$currentPage = $listOrder['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Đơn hàng sản phẩm')
@section('content')


    <section class="content">

                <div class="container">
                    <h2 class="text-center leader-title">Danh sách đơn hàng sản phẩm</h2>
                    <div class="card shadow mb-4">
                        {{-- <div class="card-header py-3">
                            <p>Tổng sản phẩm đã mua: {{($buy['total_money'])}} VNĐ
                            </p>
                            <p>Tổng số tiền đã mua: {{number_format($buy['total_money'])}} VNĐ
                                </p>
                            <p>Tên CTV: {{$buy['user']['name']}}</p>
                            <p>Tên định danh: {{$buy['user']['identifier_name']}}</p>
                           
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
                                </div>
                            </form>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="text-right mb-2"><a href="{{asset('excel-order')}}" class="btn btn-info">Xuất excel</a></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            {{-- <th>Mã CTV</th> --}}
                                            <th>Tên người mua</th>
                                            <th>Tổng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tiền ship</th>
                                           
                                            <th >Thời gian mua</th>
                                            <th>Trạng thái</th>
                                            {{-- <th>Nội dung mua</th> --}}
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php if (isset($listOrder['data']) && $listOrder['data'] != null) { ?>
                                            
                                        @foreach ($listOrder['data'] as $index=>$item)
                                            @php
                                                $date = date(' d-m-Y', strtotime($item['created_at']));
                                                $id = $item['id'];
                                                if ($item['status'] == 1) {
                                                    $status = 'Chờ xác nhận';
                                                    $none = '';
                                                }
                                                if($item['status'] == 2) {
                                                    $status = 'Đang giao hàng';
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
                                                <td>{{ $index+1 }}</td>
                                                {{-- <td></td> --}}
                                                <td>{{ $item['name_user'] }}</td>
                                                <td>{{ $item['total_product']}}</td>
                                                <td>{{ number_format($item['total_money_product']) }} đ</td>
                                                <td>{{ number_format($item['ship']) }}</td>
                                                <td>{{ $date }}</td>
                                                {{-- <td>{!! $item['content'] !!}</td> --}}
                                                <td>{{ $status }}</td>
                                                {{-- <td>
                                                    <p class="content-buy-packet">{!! $item['content'] !!}</p>
                                                </td> --}}
                                             
                                                <td>
                                                    <a href="{{ asset('chi-tiet-don-hang/id=' . $id) }}"><i
                                                            class="fas fa-eye" style="cursor: pointer;"></i></a>
                                                   
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="deleteModal{{$id}}" tabindex="-1" role="dialog"
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


                                    </tbody>
                                </table>
                                 {{-- ======= phân trang ======== --}}
                    <ul class="pagination justify-content-end">
                        <li class="page-item"><a class="page-link" href="{{ asset('danh-sach-mua-san-pham/1') }}">Đầu</a>
                        </li>

                        @if (($currentPage - 1) >= 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('danh-sach-mua-san-pham/' . ($currentPage - 1)) }}"> <i
                                        class="fas fa-angle-left"></i></a></li>
                        @endif
                        @if (($currentPage - 1) >= 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('danh-sach-mua-san-pham/' . ($currentPage - 1)) }}">{{ ($currentPage - 1) }}</a>
                            </li>
                        @endif
                        <li class="page-item {{ 'active' }}"><a class="page-link"
                                href="{{ asset('danh-sach-mua-san-pham/' . $currentPage) }}">{{ $currentPage }}</a>
                        </li>
                        @if (($currentPage + 1) <= $totalPage)
                            <li class="page-item "><a class="page-link"
                                    href="{{ asset('danh-sach-mua-san-pham/' . ($currentPage + 1)) }}">{{ ($currentPage + 1) }}</a>
                            </li>
                        @endif
                        {{-- @endfor --}}
                        @if (($currentPage + 1) <= $totalPage)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('danh-sach-mua-san-pham/' . ($currentPage + 1)) }}"> <i
                                        class="fas fa-angle-right"></i></a></li>
                        @endif
                        <li class="page-item"><a class="page-link"
                                href="{{ asset('danh-sach-mua-san-pham/' . $totalPage) }}">Cuối</a></li>
                    </ul>
                    {{-- ==========hết phân trang ============ --}}


                            </div>
                        </div>
                    </div>

                </div>
    </section>
          @endsection
       