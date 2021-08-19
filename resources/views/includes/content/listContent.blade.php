@php
$totalPage = $listContent['last_page'];
$currentPage = $listContent['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Danh sách bài đăng')
@section('content')


    <section class="content">



        <div class="container">
            <h1 class="text-center leader-title">Danh sách bài đăng</h1>
            <div class="card shadow mb-4">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="GET" id="formSearchData">
                            <div class="row d-flex align-items-end">

                                <div class="col-12 col-md-2">
                                    <label>Tên bài viết</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="title"
                                            value="@if (isset($title)) {{ $title }} @endif" placeholder="Tên bài viết"
                                            id="">
                                    </div>
                                    <!-- input-group -->
                                </div>
                                <div class="col-12 col-md-2">
                                    <label>Loại bài viết</label>
                                    <div class="input-group">
                                        <select name="category_id" class="select2 d-block form-control">
                                            <option value="0">--Loại bài viết--</option>

                                            @foreach ($listCategory['data'] as $cate)

                                                @if (!empty($cate['children']))
                                                    @foreach ($cate['children'] as $item)
                                                        <option value="{{ $item['id'] }}" @if (isset($category_id) && $category_id == $item['id']) selected @endif>{{ $cate['name'] }}--
                                                            {{ $item['name'] }}</option>

                                                    @endforeach
                                                @else
                                                    <option value="{{ $cate['id'] }}" @if (isset($category_id) && $category_id == $cate['id']) selected @endif>{{ $cate['name'] }}
                                                    </option>

                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- input-group -->
                                </div>

                                <div class="col-12 col-md-2">
                                    <label>Người đăng</label>
                                    <div class="input-group">
                                        <select name="user_id" class=" form-control">
                                            <option value="0">--Người đăng--</option>
                                            @foreach ($listUserContent as $user)
                                                <option value="{{ $user['id'] }}" @if (isset($user_id) && $user_id == $user['id']) selected @endif>{{ $user['name'] }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                    <!-- input-group -->
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="">Từ ngày:</label>

                                    <div class="input-group ">
                                        <input type="date" class="form-control" name="from_date"
                                            value="{{ $from_date }}">
                                        {{-- {{ dd($from_date)}} --}}
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="">Đến ngày:</label>

                                    <div class="input-group ">
                                        <input type="date" class="form-control" name="to_date"
                                            value="{{ $to_date }}">
                                    </div>
                                </div>



                                {{-- <div class="col-12 col-md-2">
                                            <label for="">Trạng thái</label>
                                            <div class="input-group">
                                                <select name="status" class="form-control" id="">
                                                    <option value="">--Trạng thái--</option>
                                                    <option value="1" @if (request('status') == 1) selected @endif>Hiện</option>
                                                    <option value="0" @if (request('status') == 0) selected @endif>Ẩn</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                <button class="btn btn-primary float-right ml-auto"
                                    style="height: 40px; float:right">Search</button>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                            style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th class="w-10">Người đăng</th>
                                    <th>Người duyệt</th>
                                    <th>Ngày đăng</th>

                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <?php $dem = 1; ?>

                            <tbody>
                                <?php if (isset($listContent['data']) && $listContent['data'] != null) { ?>

                                @foreach ($listContent['data'] as $key => $item)
                                    @if ($item['status'] == 2)
                                        @php
                                            $date = date(' d-m-Y', strtotime($item['created_at']));
                                            
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>{{ $item['category']['name'] }}</td>
                                            <td>{{ $item['user']['name'] }}</td>
                                            <td>
                                                @if ($item['status'] == 2)
                                                    {{ $item['reviewer']['name'] }} @endif
                                            </td>
                                            <td>{{ $date }} </td>


                                            <td>

                                                <a href="{{ asset('chi-tiet-bai-dang/' . $item['id']) }}"><i
                                                        class="fas fa-eye" style="cursor: pointer;"></i></a>

                                            </td>
                                        </tr>

                                    @endif
                                @endforeach
                                <?php } else {echo 'dữ liệu trống!';} ?>
                                <tr>
                                    <td colspan="7" class="text-center" boder:none>
                                        {{-- ======= phân trang ======== --}}
                                        <ul class="pagination justify-content-end">
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('bai-dang/1') }}">Đầu</a>
                                            </li>

                                            @if ($currentPage - 1 >= 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('bai-dang/' . ($currentPage - 1)) }}">
                                                        <i class="fas fa-angle-left"></i></a></li>
                                            @endif
                                            @if ($currentPage - 1 >= 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('bai-dang/' . ($currentPage - 1)) }}">{{ $currentPage - 1 }}</a>
                                                </li>
                                            @endif
                                            <li class="page-item {{ 'active' }}"><a class="page-link"
                                                    href="{{ asset('bai-dang/' . $currentPage) }}">{{ $currentPage }}</a>
                                            </li>
                                            @if ($currentPage + 1 <= $totalPage)
                                                <li class="page-item "><a class="page-link"
                                                        href="{{ asset('bai-dang/' . ($currentPage + 1)) }}">{{ $currentPage + 1 }}</a>
                                                </li>
                                            @endif
                                            {{-- @endfor --}}
                                            @if ($currentPage + 1 <= $totalPage)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('bai-dang/' . ($currentPage + 1)) }}">
                                                        <i class="fas fa-angle-right"></i></a></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('bai-dang/' . $totalPage) }}">Cuối</a>
                                            </li>
                                        </ul>
                                        {{-- ==========hết phân trang ============ --}}
                                    </td>
                                </tr>

                            </tbody>

                        </table>


                    </div>
                </div>
            </div>

        </div>
        </div>

    </section>


@endsection
