@extends('layouts.app')
@section('title-page', 'Banner')
@section('after-css')
    <link rel="stylesheet" href="{{ asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2 class="card-title">Danh sách banner</h2>
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
                                        <th class="text-center">Ảnh</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $index => $banner)
                                        <tr>

                                            <th scope="row" style="vertical-align: middle ">{{ ++$index }}</th>
                                            <td class="text-center"><img src="{{ $banner['image'] }}" alt=""
                                                    style="max-width: 250px; max-width: 250px; object-fit:cover"></td>

                                            <td style="vertical-align: middle ">
                                                <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                                    data-target="#delete{{ $banner['id'] }}">
                                                    <i class="fas fa-trash"></i>

                                                </a>
                                            </td>
                                            <!-- delete Modal-->
                                            <div class="modal fade" id="delete{{ $banner['id'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn
                                                                chắn
                                                                muốn
                                                                xoá?</h5>
                                                            <button class="close" type="button"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Huỷ</button>
                                                            <form action="{{ route('banners.delete', $banner['id']) }}"
                                                                method="get">
                                                                @csrf

                                                                <button class="btn btn-danger" href="">Xoá</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach

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
                    <h4 class="modal-title">Thêm mới banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('banners.store') }}" method="post" id="formAddcategory"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
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
        $('.addProductByCate').click(function(e) {
            e.preventDefault();
            let action = $(this).attr('href');
            let name_cate = $(this).attr('cate_name');
            let category_parent_id = $(this).attr('category_parent_id');
            $('#formAddProductByCate').attr('action', action);
            $('#name_cate').val(name_cate);
            $('#category_parent_id').val(category_parent_id);
            $('#modalAddProduct').modal('show');
        })

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
