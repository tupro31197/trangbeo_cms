@extends('layouts.app')
@section('title-page', 'Chi tiết món ăn')
@section('after-css')
    <link rel="stylesheet" href="{{ asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')


    <section class="content">



        <div class="container">
            <h1 class="text-center leader-title">Chi tiết món ăn: </h1>
            <div class="card shadow mb-4">

                <div class="card-body">
                    <table class="table">
                        <tr class="row">
                            <th class="col-md-3 col-3">Tên món ăn</th>
                            <td class="col-md-9 col-9"> {{ $detail['name'] }}</td>

                        </tr>
                        <tr class="row">
                            <th class="col-md-3 col-3">Giá tiền</th>
                            <td class="col-md-9 col-9"> {{ number_format($detail['money']) }}</td>

                        </tr>
                        <tr class="row">
                            <th class="col-md-3 col-3">Số lượng</th>
                            <td class="col-md-9 col-9"> {{ $detail['count'] }}</td>

                        </tr>
                        <tr class="row">
                            <th class="col-md-3 col-3">Số lượng đã bán</th>
                            <td class="col-md-9 col-9"> {{ $detail['total_count_sold'] }}</td>
                        </tr>

                        <tr class="row">
                            <th class="col-md-3 col-3 ">Ảnh món ăn: </th>
                            <td class="col-md-9 col-9">
                                <img src="{{ $detail['image'] }}" alt=""
                                    style="max-width: 200px; max-height:200px; object-fit:cover">
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-md-3 col-3 ">Topping món ăn: </th>
                            <td class="col-md-9 col-9 table-responsive">
                                <div class="text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalAddTopping">Topping +
                                    </a>
                                    <a href="" class="btn btn-success" data-toggle="modal"
                                        data-target="#modalAddTypeTopping">Topping loại +
                                    </a>
                                </div>
                                <table class="table table-bordered">

                                    <tr>
                                        <th class="w-30">Tên:</th>
                                        <th class="w-20">Số lượng giới hạn</th>
                                        <th class="w-50" colspan="3">Loại</th>
                                        <th></th>

                                    </tr>

                                    @foreach ($detail['category_topping'] as $key => $item)
                                        @php
                                            if (count($item['topping']) == 0) {
                                                $count = 1;
                                            } else {
                                                $count = count($item['topping']);
                                            }
                                        @endphp
                                        <tr>
                                            <td rowspan="{{ $count }}">{{ $item['name'] }}</td>
                                            <td rowspan="{{ $count }}">{{ $item['limit'] }}</td>


                                            @foreach ($item['topping'] as $key2 => $item2)
                                                @if ($key2 == 0)
                                                    <td>{{ $item2['name'] }}</td>
                                                    <td>{{ number_format($item2['money']) }} đ </td>
                                                    <td>
                                                        <a href="" data-toggle="modal"
                                                            data-target="#delete{{ $item2['id'] }}"
                                                            class="btn btn-danger btn-circle btn-sm editcategory">
                                                            <i class="fas fa-trash"></i>
                                                            <a href="" data-toggle="modal"
                                                                data-target="#update{{ $item2['id'] }}"
                                                                class="btn btn-warning btn-circle btn-sm editcategory">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <!-- delete Modal-->
                                                            @if($item2['status'] == 1)
                                                            <a class="btn btn-default btn-circle btn-sm" style="background: #f05e19" href="" data-toggle="modal"
                                                               data-target="#overTopping{{ $item2['id'] }}">
                                                                Hết topping
                                                            </a>
                                                            <!-- overDish Modal-->
                                                            <div class="modal fade" id="overTopping{{ $item2['id'] }}" tabindex="-1"
                                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                                                muốn xác nhận hết topping?</h5>
                                                                            <button class="close" type="button" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Tên món ăn: {{ $item2['name'] }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button"
                                                                                    data-dismiss="modal">Huỷ</button>
                                                                            <form
                                                                                action="{{ route('dish.overTopping', ['id' => $item2['id']]) }}"
                                                                                method="post">
                                                                                @csrf

                                                                                <button class="btn btn-danger" href="">Xác nhận</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @elseif($item2['status'] == 2)
                                                            <a class="btn btn-default btn-circle btn-sm" style="background: #f05e19" href="" data-toggle="modal"
                                                               data-target="#activeDish{{ $item2['id'] }}">
                                                                Mở lại topping
                                                            </a>
                                                            <!-- activeDish Modal-->
                                                            <div class="modal fade" id="activeDish{{ $item2['id'] }}" tabindex="-1"
                                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                                                muốn mở lại món?</h5>
                                                                            <button class="close" type="button" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Tên món ăn: {{ $item2['name'] }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button"
                                                                                    data-dismiss="modal">Huỷ</button>
                                                                            <form
                                                                                action="{{ route('dish.overTopping', ['id' => $item2['id']]) }}"
                                                                                method="post">
                                                                                @csrf

                                                                                <button class="btn btn-danger" href="">Xác nhận</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif


                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $item2['name'] }}</td>
                                            <td>{{ number_format($item2['money']) }} đ </td>
                                            <td>

                                                <a href="" data-toggle="modal" data-target="#delete{{ $item2['id'] }}"
                                                    class="btn btn-danger btn-circle btn-sm editcategory">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="" data-toggle="modal" data-target="#update{{ $item2['id'] }}"
                                                    class="btn btn-warning btn-circle btn-sm editcategory">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($item2['status'] == 1)
                                                <a class="btn btn-default btn-circle btn-sm" style="background: #f05e19" href="" data-toggle="modal"
                                                   data-target="#overTopping{{ $item2['id'] }}">
                                                    Hết topping
                                                </a>
                                                <!-- overDish Modal-->
                                                <div class="modal fade" id="overTopping{{ $item2['id'] }}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                                    muốn xác nhận hết topping?</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Tên món ăn: {{ $item2['name'] }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Huỷ</button>
                                                                <form
                                                                    action="{{ route('dish.overTopping', ['id' => $item2['id']]) }}"
                                                                    method="post">
                                                                    @csrf

                                                                    <button class="btn btn-danger" href="">Xác nhận</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @elseif($item2['status'] == 2)
                                                <a class="btn btn-default btn-circle btn-sm" style="background: #f05e19" href="" data-toggle="modal"
                                                   data-target="#activeDish{{ $item2['id'] }}">
                                                    Mở lại topping
                                                </a>
                                                <!-- activeDish Modal-->
                                                <div class="modal fade" id="activeDish{{ $item2['id'] }}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                                    muốn mở lại món?</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Tên món ăn: {{ $item2['name'] }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Huỷ</button>
                                                                <form
                                                                    action="{{ route('dish.overTopping', ['id' => $item2['id']]) }}"
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

                                        </tr>
                                    @endif
                                    <div class="modal fade" id="delete{{ $item2['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn
                                                        muốn xoá?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Tên topping: {{ $item2['name'] }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <form
                                                        action="{{ route('dish.deleteTopping', ['id' => $item2['id']]) }}"
                                                        method="post">
                                                        @csrf

                                                        <button class="btn btn-danger" href="">Xoá</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="update{{ $item2['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật </h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('dish.updateDishTopping') }}" method="post"
                                                        id="formAddDish" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="dish_name">Tên món ăn</label>
                                                                        <input type="text" autocomplete="off"
                                                                            class="form-control" id="dish_name"
                                                                            value="{{ $detail['name'] }}" readonly>
                                                                        <input type="text" autocomplete="off" name="dish_id"
                                                                            value="{{ $detail['id'] }}" hidden>

                                                                    </div>
                                                                </div>
                                                                <div class="col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="topping_name">Tên topping:</label>
                                                                        <input type="text" autocomplete="off"
                                                                            class="form-control" id="topping_name"
                                                                            required name="name"
                                                                            placeholder="Tên topping ... "
                                                                            value="{{ $item2['name'] }}">
                                                                        <input type="text" autocomplete="off"
                                                                            name="topping_id" value="{{ $item2['id'] }}"
                                                                            hidden>

                                                                    </div>
                                                                </div>
                                                                <div class="col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="limit">Giá:</label>
                                                                        <input type="number" autocomplete="off"
                                                                            class="form-control" id="limit" required
                                                                            name="money" placeholder="Số lượng giới hạn... "
                                                                            value="{{ $item2['money'] }}">
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->

                                                        <div class="modal-footer justify-content-between">

                                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endforeach
                                </table>
                            </td>
                        </tr>


                    </table>

                </div>
            </div>

        </div>
        </div>
        <div class="modal fade" id="modalAddTopping">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm topping</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dish.addDishTopping') }}" method="post" id="formAddDish"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="dish_name">Tên món ăn</label>
                                            <input type="text" autocomplete="off" class="form-control" id="dish_name"
                                                value="{{ $detail['name'] }}" readonly>
                                            <input type="text" autocomplete="off" name="dish_id"
                                                value="{{ $detail['id'] }}" hidden>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="topping_name">Tên topping:</label>
                                            <input type="text" autocomplete="off" class="form-control" id="topping_name"
                                                required name="name" placeholder="Tên topping ... ">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="limit">Số lượng giới hạn:</label>
                                            <input type="number" autocomplete="off" class="form-control" id="limit"
                                                required name="limit" placeholder="Số lượng giới hạn... ">
                                        </div>
                                    </div>

                                    <div class="col-12" id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" autocomplete="off" name="topping_name[]" id=""
                                                placeholder="Tên topping" class="form-control mr-2">
                                            <input type="number" autocomplete="off" name="topping_price[]" id=""
                                                placeholder="Giá" class="form-control ml-2 mr-2">
                                            <div class="input-group-append">
                                                <button id="addRow" type="button" class="btn btn-info">Thêm +</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="newRow"></div>


                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="modal-footer justify-content-between">

                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modalAddTypeTopping">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm loại topping</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dish.addTypeToping') }}" method="post" id="formAddDish"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="dish_name">Tên món ăn</label>
                                            <input type="text" autocomplete="off" class="form-control" id="dish_name"
                                                value="{{ $detail['name'] }}" readonly>
                                            <input type="text" autocomplete="off" name="dish_id"
                                                value="{{ $detail['id'] }}" hidden>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="dish_name">Danh mục toping</label>
                                            <select name="category_topping_id" class="form-control" id="changeCategoryToping">
                                                <option value="">--Chọn toping--</option>
                                                @foreach ($detail['category_topping'] as $toping)
                                                    <option value="{{ $toping['id'] }}" limit="{{ $toping['limit'] }}">{{ $toping['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="dish_name">Giới hạn</label>
                                            <input type="text" autocomplete="off" name="limit" class="form-control" id="limit_category_topping"
                                                value="0">
                                        </div>
                                    </div>
                                    <div class="col-12" id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" autocomplete="off" name="name" id=""
                                                placeholder="Tên topping" class="form-control mr-2">
                                            <input type="number" autocomplete="off" name="money" id="" placeholder="Giá"
                                                class="form-control ml-2 mr-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="modal-footer justify-content-between">

                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
@endsection
@section('after-scripts')
    <script>
        $('#changeCategoryToping').change(function(){
            const limit = $('#changeCategoryToping option:selected').attr('limit');
            $('#limit_category_topping').val(limit);
        });
    </script>
@endsection


<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('layout/libjs')
<script type="text/javascript">
    $(document).on('click', '#addRow', function() {
        var html = '';

        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html +=
            '<input type="text" autocomplete="off" name="topping_name[]" id="" placeholder="Tên topping" class="form-control mr-2">';
        html +=
            '<input type="number" name="topping_price[]" id="" placeholder="Giá" class="form-control ml-2 mr-2">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Xoá</button>';
        html += '</div>';
        html += '</div>';



        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });

</script>

</body>

</html>
