@extends('layouts.app')
@section('title-page', 'Cài đặt')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2 class="card-title">Cài đặt</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('settings.update', $setting['id']) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Quà tặng mở tài khoản</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Số tiền</label>
                                                    <input type="text" autocomplete="off" name="register_money" required
                                                value="{{ $setting['register_money'] }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="form-group ">
                                    <div class="flex ml-2">
                                        <label>Quà tặng mở tài khoản</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" name="register_money" required
                                                value="{{ $setting['register_money'] }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Địa chỉ cửa hàng</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" class="form-control" name="store_address[name]"
                                                        value="{{ $setting['store_address']['name'] }}"
                                                        placeholder="Địa chỉ" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Kinh độ</label>
                                                    <input type="text" class="form-control" name="store_address[long]"
                                                        value="{{ $setting['store_address']['long'] }}"
                                                        placeholder="Kinh độ" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vĩ độ</label>
                                                    <input type="text" class="form-control" name="store_address[lat]"
                                                        value="{{ $setting['store_address']['lat'] }}"
                                                        placeholder="Vĩ độ" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin chuyển khoản</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Tên ngân hàng</label>
                                                    <input type="text" class="form-control" name="bank_setting[bank_name]"
                                                        value="{{ $setting['bank_setting']['bank_name'] }}"
                                                        placeholder="Tên ngân hàng" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Chi nhánh</label>
                                                    <input type="text" class="form-control" name="bank_setting[branch]"
                                                        value="{{ $setting['bank_setting']['branch'] }}"
                                                        placeholder="Chi nhánh" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Số tài khoản</label>
                                                    <input type="text" class="form-control"  name="bank_setting[number]"
                                                    value="{{ $setting['bank_setting']['number'] }}"
                                                        placeholder="Số tài khoản" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tên tài khoản</label>
                                                    <input type="text" class="form-control" name="bank_setting[account_name]"
                                                        value="{{ $setting['bank_setting']['account_name'] }}"
                                                        placeholder="Tên tài khoản" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Chi phí vận chuyển</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-3"><label>Từ </label></div>
                                                    <div class="col-md-3"><label>Đến</label></div>
                                                    <div class="col-md-3"><label>Chi phí</label></div>
                                                </div>
                                                <div class="ship_costs">
                                                    @foreach ($setting['distance_price'] as $item)
                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="text" autocomplete="off" name="from[]" required
                                                                    value="{{ $item['from'] }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" autocomplete="off" name="to[]" required
                                                                    value="{{ $item['to'] }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" autocomplete="off" name="price[]" required
                                                                    value="{{ $item['price'] }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button type="button"
                                                                    class="btn btn-block btn-danger deleteItem">Xóa</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mb-3 row">
                                            <div class="col-3 ">
                                                <button class="btn btn-block btn-primary add_ship_cost">Thêm chi phí</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="col-3 ">
                                        <button type="submit" class="btn btn-block btn-success">Lưu lại</button>
                                    </div>
                                </div>

                            </form>

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
@endsection
@section('after-scripts')
    <script>
        $('.add_ship_cost').click(function(e) {
            e.preventDefault();
            var add_ship_cost = '';
            add_ship_cost += '<div class="row mb-3">';
            add_ship_cost += '<div class="col-md-3">';
            add_ship_cost +=
                '<input type="text" autocomplete="off" name="from[]" required value="" class="form-control">';
            add_ship_cost += '</div>';
            add_ship_cost += '<div class="col-md-3">';
            add_ship_cost +=
                '<input type="text" autocomplete="off" name="to[]" required value=""  class="form-control">';
            add_ship_cost += '</div>';
            add_ship_cost += '<div class="col-md-3">';
            add_ship_cost +=
                '<input type="text" autocomplete="off" name="price[]" required value="" class="form-control">';
            add_ship_cost += '</div>';
            add_ship_cost += '<div class="col-md-3">';
            add_ship_cost += '<button type="button" class="btn btn-block btn-danger deleteItem">Xóa</button>';
            add_ship_cost += '</div>';
            add_ship_cost += '</div>';
            $('.ship_costs').append(add_ship_cost);
        });
        $(document).on("click", '.deleteItem', function() {
            $(this).parent().parent().remove();
        })
    </script>
@endsection
