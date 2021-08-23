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
                    <div class="text-right p-2">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addVoucher">Thêm mới</button>
                        <!-- delete Modal-->
                        <div class="modal fade" id="addVoucher" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới voucher</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('voucher.addVoucher') }}"
                                        method="post">
                                        @csrf
                                        <div class="modal-body text-left">
                                            <label for="">Voucher</label>
                                            <input type="number" class="form-control" name="percent" placeholder="Nhập thông tin mã giảm">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Huỷ</button>


                                            <button class="btn btn-primary" href="">Thêm mới</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

                                @foreach ($vouchers['data'] as $index => $item)
                                    @php
                                        $id = $item['id'];
                                        if ($item['status'] == 0) {
                                            $status = 'Chưa sử dụng';
                                            $color = '';
                                        } elseif ($item['status'] == 1) {
                                            $status = 'Đang sử dụng';
                                            $color = 'green';
                                        }
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $item['value'] }}</td>
                                        <td style="color: {{ $color }}">{{ $status }}</td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <a href="" data-toggle="modal" data-target="#updateVoucher{{$id}}"><input type="checkbox" @if ($item['status'] == 1) {{ 'checked' }} @endif data-toggle="modal"
                                                    data-target="#update{{ $item['id'] }}" >
                                                <span class="slider round"></span></a>
                                            </label>
                                            {{-- <a href="{{ asset('chi-tiet/id=' . $id) }}"><i
                                                            class="fas fa-eye" style="cursor: pointer;"></i></a> --}}

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="updateVoucher{{ $id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="p-5">
                                                            <div class="text-center">
                                                                <h1 class="h4 text-gray-900 mb-4 text-left">
                                                                    @if ($item['status']==0)
                                                                       {{ 'Bạn có chắc chắn muốn dùng voucher này?' }}
                                                                    @else 
                                                                    {{ 'Bạn có chắc chắn muốn huỷ dùng voucher này?'}}
                                                                    @endif
                                                                </h1>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Không</button>
                                                                    <form action="{{ asset('voucher/cap-nhat/'.$id) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-primary">Có</button>
                                                                    </form>
                                                                    
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

                            @if ($currentPage - 1 >= 1)
                                <li class="page-item"><a class="page-link"
                                        href="{{ asset('danh-sach-voucher/' . ($currentPage - 1)) }}"> <i
                                            class="fas fa-angle-left"></i></a></li>
                            @endif
                            @if ($currentPage - 1 >= 1)
                                <li class="page-item"><a class="page-link"
                                        href="{{ asset('danh-sach-voucher/' . ($currentPage - 1)) }}">{{ $currentPage - 1 }}</a>
                                </li>
                            @endif
                            <li class="page-item {{ 'active' }}"><a class="page-link"
                                    href="{{ asset('danh-sach-voucher/' . $currentPage) }}">{{ $currentPage }}</a>
                            </li>
                            @if ($currentPage + 1 <= $totalPage)
                                <li class="page-item "><a class="page-link"
                                        href="{{ asset('danh-sach-voucher/' . ($currentPage + 1)) }}">{{ $currentPage + 1 }}</a>
                                </li>
                            @endif
                            {{-- @endfor --}}
                            @if ($currentPage + 1 <= $totalPage)
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
