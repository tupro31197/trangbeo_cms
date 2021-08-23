@php
$totalPage = $vouchers['total_page'];
$currentPage = $vouchers['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Voucher')
@section('content')


    <section class="content">

                <div class="container">
                    <h2 class="text-center leader-title">Danh sách voucher</h2>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Voucher giảm</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                               
                                        @foreach ($vouchers['data'] as $index=>$item)
                                            @php
                                              $id = $item['id'];
                                                if ($item['status'] == 0) {
                                                    $status = 'Chưa sử dụng';
                                                    $color  = '';
                                                    
                                                }
                                                else if($item['status'] == 1) {
                                                    $status = 'Đang sử dụng';
                                                    $color  = 'green';
                                                }
                                               
                                            @endphp
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $item['value'] }}</td>
                                                <td style="color: {{$color}}">{{ $status }}</td>
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" @if($item['status']==1) {{'checked'}} @endif data-toggle="modal"
                                                        data-target="#update{{ $item['id'] }}">
                                                        <span class="slider round" ></span>
                                                      </label>
                                                    {{-- <a href="{{ asset('chi-tiet/id=' . $id) }}"><i
                                                            class="fas fa-eye" style="cursor: pointer;"></i></a> --}}
                                                   
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
                                                                        {{-- <button type="submit" class="btn btn-primary"><a
                                                                                href="{{ asset('huy-goi-mua/id=' . $id) }}"
                                                                                style="color: #fff;">Có</a></button> --}}
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
    
                                            </div>
                                        </div>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                                 {{-- ======= phân trang ======== --}}
                    <ul class="pagination justify-content-end">
                        <li class="page-item"><a class="page-link" href="{{ asset('danh-sach-voucher/1') }}">Đầu</a>
                        </li>

                        @if (($currentPage - 1) >= 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('danh-sach-voucher/' . ($currentPage - 1)) }}"> <i
                                        class="fas fa-angle-left"></i></a></li>
                        @endif
                        @if (($currentPage - 1) >= 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('danh-sach-voucher/' . ($currentPage - 1)) }}">{{ ($currentPage - 1) }}</a>
                            </li>
                        @endif
                        <li class="page-item {{ 'active' }}"><a class="page-link"
                                href="{{ asset('danh-sach-voucher/' . $currentPage) }}">{{ $currentPage }}</a>
                        </li>
                        @if (($currentPage + 1) <= $totalPage)
                            <li class="page-item "><a class="page-link"
                                    href="{{ asset('danh-sach-voucher/' . ($currentPage + 1)) }}">{{ ($currentPage + 1) }}</a>
                            </li>
                        @endif
                        {{-- @endfor --}}
                        @if (($currentPage + 1) <= $totalPage)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('danh-sach-voucher/' . ($currentPage + 1)) }}"> <i
                                        class="fas fa-angle-right"></i></a></li>
                        @endif
                        <li class="page-item"><a class="page-link"
                                href="{{ asset('danh-sach-voucher/' . $totalPage) }}">Cuối</a></li>
                    </ul>
                    {{-- ==========hết phân trang ============ --}}


                            </div>
                        </div>
                    </div>

                </div>
    </section>
          @endsection
       