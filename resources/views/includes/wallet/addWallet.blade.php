@extends('layouts.app')
@section('title-page', 'Nạp/rút tiền')
@section('content')


    <section class="content">

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin giao dịch</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('createWallet') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="inputNameProduct">Chọn hình thức</label>
                                                <select name="wallet" class="d-block select2 form-control" id="">
                                                    <option value="1">Nạp tiền</option>
                                                    <option value="2">Rút tiền</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Họ tên</label>
                                                <input type="text" class="form-control formatPrice" id="name" name="account_name"
                                                    placeholder="Nhập họ tên">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="bank_name">Ngân hàng</label>
                                                <input type="text" class="form-control formatPrice" id="bank_name"
                                                    name="bank_name" placeholder="Nhập tên ngân hàng">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="branch">Chi nhánh</label>
                                                <input type="text" class="form-control formatPrice" id="branch"
                                                    name="branch" placeholder="Nhập tên chi nhánh ngân hàng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="account_stk">Số tài khoản</label>
                                                <input type="text" id="account_stk" name="account_stk" class="form-control" placeholder="Nhập số tài khoản ngân hàng">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="money">Số tiền</label>
                                                <input type="text" id="money" name="money" class="form-control" placeholder="Nhập số tiền giao dịch">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="content">Nội dung giao dịch</label>
                                                <input type="text" class="form-control " id="content"
                                                    name="content" placeholder="Nhập nội dung giao dịch">
                                            </div>
                                        </div>
                                    
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="image">Ảnh hoá đơn/chuyển khoản</label>
                                                <div class="image-input">
                                                    <input type="file" accept="image/*" id="image" name="image">
                                                    <img src="" class="image-preview" style="max-width:100px">
    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
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
