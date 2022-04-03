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
                                <div class="form-group ">
                                    <div class="flex ml-2">
                                        <label>Quà tặng mở tài khoản</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" name="register_money"
                                                value="{{ $setting['register_money'] }}" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-2">
                                    <label>Chi phí vận chuyển</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4"><label>Từ </label></div>
                                        <div class="col-md-4"><label>Đến</label></div>
                                        <div class="col-md-4"><label>Chi phí</label></div>
                                    </div>
                                    <div class="ship_costs">
                                        @foreach ($setting['distance_price'] as $item)
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <input type="text" autocomplete="off" name="from[]" value="{{ $item['from'] }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" autocomplete="off" name="to[]" value="{{ $item['to'] }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" autocomplete="off" name="price[]" value="{{ $item['price'] }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button"
                                                        class="btn btn-block btn-danger deleteItem">Xóa</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="col-2 ">
                                        <button class="btn btn-block btn-primary add_ship_cost">Thêm chi phí</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="col-2 ">
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
        $('.add_ship_cost').click(function(e){
            e.preventDefault();
            var add_ship_cost = '';
            add_ship_cost += '<div class="row mb-3">';
                add_ship_cost += '<div class="col-md-3">';
                    add_ship_cost += '<input type="text" autocomplete="off" name="from[]" value="" class="form-control">';
                add_ship_cost += '</div>';
                add_ship_cost += '<div class="col-md-3">';
                    add_ship_cost += '<input type="text" autocomplete="off" name="to[]" value=""  class="form-control">';
                add_ship_cost += '</div>';
                add_ship_cost += '<div class="col-md-3">';
                    add_ship_cost += '<input type="text" autocomplete="off" name="price[]" value="" class="form-control">';
                add_ship_cost += '</div>';
                add_ship_cost += '<div class="col-md-3">';
                    add_ship_cost += '<button type="button" class="btn btn-block btn-danger deleteItem">Xóa</button>';
                add_ship_cost += '</div>';
            add_ship_cost += '</div>';
            $('.ship_costs').append(add_ship_cost);
        });
        $(document).on("click",'.deleteItem', function() {
            $(this).parent().parent().remove();
        })
    </script>
@endsection
