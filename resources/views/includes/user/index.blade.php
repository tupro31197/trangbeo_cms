@php
$totalPage = $users['total_page'];
$currentPage = $users['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Người dùng')
@section('content')


    <section class="content">

                <div class="container">
                    <h2 class="text-center leader-title">Danh sách người dùng</h2>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Tên</th>
                                            <th>SĐT</th>
                                            
                                            <th>Trạng thái</th>
                                         
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                               
                                        @foreach ($users['data'] as $index=>$item)
                                            @php
                                              $id = $item['id'];
                                                if(isset($item['status']) && $item['status'] == 1) {
                                                    $status = 'Đang hoạt động';
                                                    $color  = 'green';
                                                }
                                                else{
                                                    $status = '';
                                                    $color  = '';
                                                }
                                               
                                            @endphp
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td class="text-center"><img src="{{ $item['avatar']}}" alt="" width="100px" height="100px" style="border-radius: 50px; object-fit:cover"></td>
                                                <td>{{ $item['name']}}</td>
                                                <td>{{ $item['phone']}}</td>
                                                <td style="color: {{$color}}">{{ $status }}</td>
                                                
                                            </tr>
                                      
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                                 {{-- ======= phân trang ======== --}}
                    <ul class="pagination justify-content-end">
                        <li class="page-item"><a class="page-link" href="{{ asset('user/danh-sach/1') }}">Đầu</a>
                        </li>

                        @if (($currentPage - 1) >= 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('user/danh-sach/' . ($currentPage - 1)) }}"> <i
                                        class="fas fa-angle-left"></i></a></li>
                        @endif
                        @if (($currentPage - 1) >= 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('user/danh-sach/' . ($currentPage - 1)) }}">{{ ($currentPage - 1) }}</a>
                            </li>
                        @endif
                        <li class="page-item {{ 'active' }}"><a class="page-link"
                                href="{{ asset('user/danh-sach/' . $currentPage) }}">{{ $currentPage }}</a>
                        </li>
                        @if (($currentPage + 1) <= $totalPage)
                            <li class="page-item "><a class="page-link"
                                    href="{{ asset('user/danh-sach/' . ($currentPage + 1)) }}">{{ ($currentPage + 1) }}</a>
                            </li>
                        @endif
                        {{-- @endfor --}}
                        @if (($currentPage + 1) <= $totalPage)
                            <li class="page-item"><a class="page-link"
                                    href="{{ asset('user/danh-sach/' . ($currentPage + 1)) }}"> <i
                                        class="fas fa-angle-right"></i></a></li>
                        @endif
                        <li class="page-item"><a class="page-link"
                                href="{{ asset('user/danh-sach/' . $totalPage) }}">Cuối</a></li>
                    </ul>
                    {{-- ==========hết phân trang ============ --}}


                            </div>
                        </div>
                    </div>

                </div>
    </section>
          @endsection
       