@extends('layouts.app')
@section('title-page', 'Thông tin tài khoản')
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin tài khoản</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('update-InformationCtv', $information['id']) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail">Email</label>
                                            <input type="text" class="form-control " id="inputEmail"
                                                value="{{ $information['email'] }}" readonly placeholder="Email">
                                        </div>
                                        {{-- {{ dd($information)}} --}}
                                        <div class="form-group">
                                            <label for="link">Link giới thiệu</label>
                                            <input type="text" class="form-control " id="link"
                                                value="{{ asset('dang-ki?key=' . base64_encode($information['cmt'])) }}"
                                                readonly placeholder="Link giới thiệu">
                                            <i class="fas fa-fw fa-paste" style="    position: absolute;
                                                        right: 10px;
                                                        top: 130px;" onclick="copytext()"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputNameCtv">Tên tài khoản</label>
                                            <input type="text" class="form-control" id="inputNameCtv" name="name"
                                                autocomplete="off" value="{{ $information['name'] }}"
                                                placeholder="Tên tài khoản">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputPhone">Số điện thoại</label>
                                            <input type="text" class="form-control " id="inputPhone"
                                                value="{{ $information['phone'] }}" readonly placeholder="Số điện thoại">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="cmt">Căn cước công dân</label>
                                            <input type="text" class="form-control " id="cmt" name="cmt"
                                                value="{{ $information['cmt'] }}" autocomplete="off"
                                                placeholder="Căn cước công dân">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputAddress">Địa chỉ</label>
                                            <input type="text" class="form-control " id="inputAddress" name="address"
                                                value="{{ $information['address'] }}" autocomplete="off"
                                                placeholder="Địa chỉ">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="image">Avatar</label>
                                            <input type="file" class="form-control " id="image" name="image">
                                            <img src="{{ $information['image']}}" width="100px" height="100px" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputAddress">Mô tả</label>
                                            <textarea class="form-control " name="description" 
                                                placeholder="Mô tả về bản thân">{{ $information['description'] }}</textarea>
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
<script>
    function copytext() {
        var copyText = document.getElementById("link");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            onClick: function() { //i want to detect tostr click with something like that.
                //do something.
            }
        });
        Toast.fire({
            type: 'success',
            title: 'Copied!'
        })
    }
</script>
