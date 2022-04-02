@php
$totalPage = $dishes['total_page'];
$currentPage = $dishes['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Món ăn')
@section('after-css')
    <link rel="stylesheet" href="{{ asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="text-center">
                <h2>Danh sách món ăn:</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ asset('mon-an/danh-sach/1') }}" method="GET" id="formSearchData">
                                <div class="row d-flex align-items-end">
                                    <div class="col-12 col-md-2">
                                        <label>Danh mục cha</label>
                                        <div class="input-group">
                                            <select name="category_parent_id" id="categoryParrent" class="form-control">
                                                <option value="">Tất cả</option>
                                                @foreach ($categories as $index => $category)
                                                    <option value="{{ $category['id'] }}" @if ($category['id'] == $category_parent_id)
                                                        {{ 'selected' }}
                                                @endif>{{ $category['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- input-group -->
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label>Danh mục con</label>
                                        <input type="text" id="id_child" value="{{$category_child_id}}" hidden>
                                        <div class="input-group">
                                            <select name="category_child_id" id="categoryChild" class="form-control">
                                                <option value="">Tất cả <option>

                                            </select>
                                        </div>
                                        <!-- input-group -->
                                    </div>


                                    <button class="btn btn-primary float-right ml-auto"
                                        style="height: 40px; float:right">Tìm kiếm</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">

                            <div class="float-right ml-auto">
                                <a class="col-md-2 col-12" href="#" data-toggle="modal" data-target="#modalAddcategory">
                                    <button class="btn btn-primary btn-sm" style="">Thêm mới + </button>
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover ">

                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên món ăn</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes['data'] as $index => $dish)

                                        <tr>

                                            <th scope="row" style="vertical-align: middle ">{{ ++$index }}</th>
                                            <td class="text-center"><img src="{{ $dish['image'] }}" alt="" width="100px"
                                                    height="100px" style="border-radius: 50px; object-fit:cover"></td>
                                            <td style="vertical-align: middle ">{{ $dish['name'] }}</td>
                                            <td>{{ number_format($dish['money']) }}</td>
                                            <td>
                                                <p>Số lượng: {{ $dish['count'] }}</p> <br>
                                                <p>Đã bán: {{ $dish['total_count_sold'] }}</p>
                                            </td>
                                            <td>
                                                @if($dish['status'] == 1) Đang hoạt động
                                                @elseif ($dish['status'] == -1) Đã bị xóa
                                                @else Hết món
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle ">
                                                <a class="btn btn-info btn-circle btn-sm" href="{{route('dish.detailDish', ['id' => $dish['id'] ])}}">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <a href="" data-toggle="modal" data-target="#update{{ $dish['id'] }}"
                                                    class="btn btn-warning btn-circle btn-sm editcategory">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                                    data-target="#delete{{ $dish['id'] }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a class="btn btn-warning btn-circle btn-sm" href="{{route('rate.listRate', ['dish_id' => $dish['id'], 'dish' => $dish['name']])}}">
                                                    <i class="fas fa-star"></i>
                                                </a>
                                                @if($dish['status'] == 1)
                                                <a class="btn btn-default btn-circle btn-sm" style="background: #f05e19" href="" data-toggle="modal"
                                                    data-target="#overDish{{ $dish['id'] }}">
                                                    Hết món
                                                </a>
                                                <!-- overDish Modal-->
                                                <div class="modal fade" id="overDish{{ $dish['id'] }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                                    muốn xác nhận hết món?</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Tên món ăn: {{ $dish['name'] }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Huỷ</button>
                                                                <form
                                                                    action="{{ route('dish.overDish', ['id' => $dish['id']]) }}"
                                                                    method="post">
                                                                    @csrf

                                                                    <button class="btn btn-danger" href="">Xác nhận</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>

                                            <!-- delete Modal-->
                                            <div class="modal fade" id="delete{{ $dish['id'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                                muốn
                                                                xoá?</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tên món ăn: {{ $dish['name'] }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Huỷ</button>
                                                            <form
                                                                action="{{ route('dish.delete', ['id' => $dish['id']]) }}"
                                                                method="post">
                                                                @csrf

                                                                <button class="btn btn-danger" href="">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- update --}}
                                            <div class="modal fade" id="update{{ $dish['id'] }}">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Cập nhật món ăn</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('dish.updateDish') }}" method="post"
                                                                id="formAddDish" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 ">
                                                                            <div class="form-group">
                                                                                <label for="inputTitle">Tên món ăn</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="inputTitle" required name="name"
                                                                                    placeholder="Tên danh mục sản phẩm"
                                                                                    value="{{ $dish['name'] }}">
                                                                                <input type="number" name="dish_id"
                                                                                    value="{{ $dish['id'] }}" hidden>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 ">
                                                                            <div class="form-group">
                                                                                <label for="inputPrice">Giá</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="inputPrice" required name="money"
                                                                                    placeholder="Giá sản phẩm"
                                                                                    value="{{ $dish['money'] }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 ">
                                                                            <div class="form-group">
                                                                                <label for="image">Ảnh</label>
                                                                                <input type="file" class="form-control"
                                                                                    id="image" name="sampleFile">
                                                                                <img src="{{ $dish['image'] }}" alt=""
                                                                                    width="100px" height="100px"
                                                                                    style="object-fit: cover">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Đóng</button>
                                                                    <button type="submit" class="btn btn-primary">Cập
                                                                        nhật</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>


                                        </tr>


                                    @endforeach
                                    <td colspan="6" class="text-center" boder:none>
                                        {{-- ======= phân trang ======== --}}

                                        <ul class="pagination justify-content-end">
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('mon-an/danh-sach/1') }}">Đầu</a>
                                            </li>

                                            @if ($currentPage - 1 >= 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('mon-an/danh-sach/' . ($currentPage - 1) ) }}">
                                                        <i class="fas fa-angle-left"></i></a></li>
                                            @endif
                                            @if ($currentPage - 1 >= 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('mon-an/danh-sach/' . ($currentPage - 1) ) }}">{{ $currentPage - 1 }}</a>
                                                </li>
                                            @endif
                                            <li class="page-item {{ 'active' }}"><a class="page-link"
                                                    href="{{ asset('mon-an/danh-sach/' . $currentPage) }}">{{ $currentPage }}</a>
                                            </li>
                                            @if ($currentPage + 1 <= $totalPage)
                                                <li class="page-item "><a class="page-link"
                                                        href="{{ asset('mon-an/danh-sach/' . ($currentPage + 1) ) }}">{{ $currentPage + 1 }}</a>
                                                </li>
                                            @endif
                                            {{-- @endfor --}}
                                            @if ($currentPage + 1 <= $totalPage)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ asset('mon-an/danh-sach/' . ($currentPage + 1) ) }}">
                                                        <i class="fas fa-angle-right"></i></a></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ asset('mon-an/danh-sach/' . $totalPage ) }}">Cuối</a>
                                            </li>
                                        </ul>
                                        {{-- ==========hết phân trang ============ --}}
                                    </td>
                                </tbody>

                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="modalAddcategory">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới món ăn</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dish.addDish') }}" method="post" id="formAddDish"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="form-group">
                                        <label for="inputTitle">Tên món ăn</label>
                                        <input type="text" class="form-control" id="inputTitle" required name="name"
                                            placeholder="Tên danh mục sản phẩm">
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group">
                                        <label for="inputPrice">Giá</label>
                                        <input type="text" class="form-control" id="inputPrice" required name="money"
                                            placeholder="Giá sản phẩm">
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group">
                                        <label for="inputType">Danh mục</label>
                                        <select name="category_parent_id" id="addCategoryParrent" class="form-control">
                                            <option value="">-- Chọn danh mục cha --</option>
                                            @foreach ($categories as $index => $category)
                                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group">
                                        <label for="inputType">Danh mục con</label>
                                        <select name="category_child_id" class="form-control" id="addCategoryChild">
                                            <option value="">-- Chọn danh mục món ăn --</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group">
                                        <label for="image">Ảnh</label>
                                        <input type="file" class="form-control" id="image" required name="sampleFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
@section('after-scripts')
    <script src="{{ asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $(function() {
            $('#imageInput').on('change', function() {
                $input = $(this);
                if ($input.val().length > 0) {
                    fileReader = new FileReader();
                    fileReader.onload = function(data) {
                        $('.image-preview').attr('src', data.target.result);
                    }
                    fileReader.readAsDataURL($input.prop('files')[0]);
                    $('.image-button').css('display', 'none');
                    $('.image-preview').css('display', 'block');
                    $('.change-image').css('display', 'block');
                }
            });

            $('.select2').select2();
            $('.change-image').on('click', function() {
                $control = $(this);
                $('#imageInput').val('');
                $preview = $('.image-preview');
                $preview.attr('src', '');
                $preview.css('display', 'none');
                $control.css('display', 'none');
                $('.image-button').css('display', 'block');
            });

            $('.change-image2').on('click', function() {
                $control = $(this);
                $('#imageInput').val('');
                $preview = $('.image-preview');
                $preview.attr('src', '');
                $preview.css('display', 'none');
                $control.css('display', 'none');
                $('.image-button').css('display', 'block');
            });


        });


        var id = document.getElementById("categoryParrent").value;
        var id_child = document.getElementById("id_child").value;

        $.ajax({
            url: "{{ asset('danh-muc/tim-kiem') }}",
            type: 'GET',
            data: {
                id: id,

            },
            success: function(response) {
                var child = '<option value="">Tất cả</option>';
                for (let i = 0; i < response.length; i++) {
                    if(response[i]['id'] == id_child){
                        child += '<option value="' + response[i]['id'] + '" selected> ' + response[i]['name'] + '</option>';

                    }
                    else child += '<option value="' + response[i]['id'] + '"> ' + response[i]['name'] + '</option>';
                }
                $('#categoryChild').html(child);

            },


        });

        $('#categoryParrent').change(function() {
            var id = document.getElementById("categoryParrent").value;

            console.log(id_child);
            $.ajax({
                url: "{{ asset('danh-muc/tim-kiem') }}",
                type: 'GET',
                data: {
                    id: id,

                },
                success: function(response) {
                    var child = '<option value="">Tất cả</option>';
                    for (let i = 0; i < response.length; i++) {
                        child += '<option value="' + response[i]['id'] + '"> ' + response[i]['name'] +
                            '</option>';
                    }
                    $('#categoryChild').html(child);

                },


            });


        });

        $('#addCategoryParrent').change(function() {
            var id = document.getElementById("addCategoryParrent").value;
            $.ajax({
                url: "{{ asset('danh-muc/tim-kiem') }}",
                type: 'GET',
                data: {
                    id: id,

                },
                success: function(response) {
                    var child = '';
                    for (let i = 0; i < response.length; i++) {
                        child += '<option value="' + response[i]['id'] + '"> ' + response[i]['name'] +
                            '</option>';
                    }
                    $('#addCategoryChild').html(child);

                },


            });


        });
    </script>

@endsection
