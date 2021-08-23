@extends('layouts.app')
@section('title-page', 'Món ăn')
@section('after-css')
    <link rel="stylesheet" href="{{ asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="GET" id="formSearchData">
                                <div class="row d-flex align-items-end">
                                    <div class="col-12 col-md-2">
                                        <label>Tiêu đề</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control" name="name"
                                                value="{{ request('name') }}" placeholder="Tiêu đề" id="startdatepicker">
                                        </div>
                                        <!-- input-group -->
                                    </div>


                                    <button class="btn btn-primary float-right ml-auto"
                                        style="height: 40px; float:right">Search</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2 class="card-title">Danh sách món ăn</h2>
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
                                        <th>Tên món ăn</th>

                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes as $index => $dish)

                                        <tr>
                                           
                                                <th scope="row" style="vertical-align: middle ">{{ ++$index }}</th>
                                                <td style="vertical-align: middle ">{{ $dish['name'] }}</td>
                                            
                                            <td style="vertical-align: middle ">
                                                <a href="" data-toggle="modal" data-target="#update{{ $dish['id'] }}"
                                                    class="btn btn-warning btn-circle btn-sm editcategory">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                                    data-target="#delete{{ $dish['id'] }}">
                                                    <i class="fas fa-trash"></i>

                                                </a>
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
                                                        <div class="modal-body">Tên món ăn: {{ $dish['name'] }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Huỷ</button>
                                                            <form
                                                                action="{{ route('dish.delete', ['id' => $dish['id']]) }}"
                                                                method="post">
                                                                @csrf

                                                                <button class="btn btn-danger" href="">Xoá</button>
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
                                                            <form action="{{ route('dish.updateParrent') }}"
                                                                method="post" id="formUpdatecategory"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 ">
                                                                            <div class="form-group">
                                                                                <label for="inputTitle">Tên món ăn:
                                                                                </label>
                                                                                <input type="text" class="form-control"
                                                                                    id="inputTitle" required name="name"
                                                                                    placeholder="Tên món ăn"
                                                                                    value="{{ $dish['name'] }}">
                                                                                <input type="text" hidden name="id"
                                                                                    value="{{ $dish['id'] }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 ">
                                                                            <div class="form-group">
                                                                                <label for="imageInput2">Ảnh</label>
                                                                                <input type="file" class="form-control"
                                                                                    id="imageInput2" required
                                                                                    name="sampleFile">
                                                                                <img src="{{ $dish['image'] }}" alt=""
                                                                                    class="image-url"
                                                                                    style="max-width:100px">
                                                                                <img src="" class="image-preview2"
                                                                                    style="max-width:100px">
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Đóng</button>
                                                                    <button type="submit" class="btn btn-primary">Lưu
                                                                        lại</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{-- ---------- --}}
                                            <div class="modal fade" id="modalAddChild{{ $dish['id'] }}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Thêm mới danh mục món ăn</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('category.addChild') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="inputNameProduct">Tên danh
                                                                                    mục</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="inputNameProduct" name="name"
                                                                                    value="" placeholder="Tên sản phẩm">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="inputNameProduct">Danh mục
                                                                                    cha</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="name_cate" readonly
                                                                                    value="{{ $dish['name'] }}">
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $dish['id'] }}"
                                                                                    name="category_parent_id" hidden>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputFile">Ảnh</label>
                                                                                <div class="image-input">
                                                                                    <input type="file" accept="image/*"
                                                                                        id="imageInput" name="sampleFile">
                                                                                    <img src="" class="image-preview"
                                                                                        style="max-width:100px">

                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Lưu</button>
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

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên món ăn</th>

                                        <th scope="col">Thao tác</th>
                                    </tr>

                                </tfoot>
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
                    <form action="{{ route('dish.addParrent') }}" method="post" id="formAddDish"
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
                                        <select name="category_parent_id">
                                            @foreach ($categories as $index => $category)
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group">
                                        <label for="inputType">Danh mục con</label>
                                        <select name="category_child_id">
                                            @foreach ($children as $index => $child)
                                                <option value="{{$child['id']}}">{{$child['name']}}</option>
                                            @endforeach
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

            $('.formatPrice').priceFormat({
                prefix: '',
                centsLimit: 0,
                thousandsSeparator: '.'
            });
            // Summernote
            $('.summernote').summernote()
        })
    </script>

@endsection
