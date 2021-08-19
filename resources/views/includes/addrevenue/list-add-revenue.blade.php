<?php
$token = Cookie::get('token'); ?>
@extends('layouts.app')
@section('title-page', 'Danh sách cộng doanh số')
@section('content')


    <section class="content">


                <div class="container">
                    <h1 class="text-center leader-title">Danh sách cộng doanh số</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p>Tổng tiền đã mua các gói: {{number_format($calculator['total_money'])}} VNĐ
                            </p>
                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="">
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control  border-1 small" placeholder="Nhập tên" value="<?php if(isset($_GET['name']))  echo $_GET['name'];?>">
                                        <input type="text" name="phone" class="form-control  border-1 small" placeholder="Nhập số điện thoại" style="margin-left:20px;" value="<?php if(isset($_GET['phone']))  echo $_GET['phone'];?>">
                                        <select name="status" id="" class="form-control  border-1 small" style="margin-left:20px;">
                                            <option value="0"@if (isset($_GET['status']) && $_GET['status']==0) selected @endif>Chờ xác nhận</option>
                                            <option value="1"@if (isset($_GET['status']) && $_GET['status']==1) selected @endif>Đã xác nhận</option>
                                            <option value="2"@if (isset($_GET['status']) && $_GET['status']==2) selected @endif>Đã hoàn thành</option>
                                            <option value="3"@if (isset($_GET['status']) && $_GET['status']==3) selected @endif>Đã hủy</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="" style="margin-left:10px; display:inline;">Từ ngày:
                                            <input type="date" name="from_date" class="form-control  border-1 small" style="margin-top:15px;" value="<?php if(isset($_GET['from_date']))  echo $_GET['from_date'];?>">
                                        </label>
                                            <label for="" style="margin-left:10px; display:inline;">Đến ngày:
                                        <input type="date" name="to_date" class="form-control  border-1 small" style="margin-top:15px;" value="<?php if(isset($_GET['to_date']))  echo $_GET['to_date'];?>">
                                    </label>
                                        <button class="btn btn-primary" type="submit" style="position: absolute; right:100px; border-top-left-radius: 5px;
                                        border-bottom-left-radius: 5px;">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Người cộng DS</th>
                                            <th>Người nhận</th>
                                            <th>SĐT người nhận</th>
                                            <th>Giá</th>
                                            <th>Nội dung</th>
                                            <th>Thời gian tạo</th>
                                            <th>Trạng thái</th>
                                            <th style="width: 100px;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $dem = 1;
                                    ?>

                                    <tbody>
                                        <?php if (isset($calculator) && $calculator != null) { ?>
                                        @foreach ($calculator['list_add_revenue']['data'] as $item)
                                            @php
                                                $date = date(' d-m-Y', strtotime($item['created_at']) );
                                                $time = date(' H:i', strtotime($item['created_at']) );
                                                $id = $item['id'];
                                                if ($item['status'] == 0) {
                                                    $status = 'Chờ xác nhận';
                                                }
                                                if ($item['status'] == 1) {
                                                    $status = 'Đã xác nhận';
                                                }
                                                if ($item['status'] == 2) {
                                                    $status = 'Chờ xác nhận cập nhật';
                                                }
                                                if ($item['status'] == 3) {
                                                    $status = 'Chờ xác nhận xóa';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $dem }}</td>
                                                <td>{{ $item['user_create']['name'] }}</td>
                                                <td>{{ $item['user']['name'] }}</td>
                                                <td>{{ $item['user']['phone'] }}</td>

                                                <td>{{ number_format($item['price']) }} VNĐ</td>
                                                <td style="width:200px;">{!!$item['content']!!}</td>
                                                <td>{{ $date }}<br>{{ $time }}</td>
                                                <td>{{ $status }}</td>
                                                <td>
                                                    <a href="{{ asset('chi-tiet-cong-doanh-so/id=' . $id) }}"><i
                                                            class="fas fa-eye" style="cursor: pointer;"></i></a>
                                                    @if($infor['code_ordinal'] == 1)
                                                        <a data-toggle="modal"
                                                            data-target="#updateaddrevenue{{ $id }}">
                                                            <i class="far fa-edit"
                                                                style="cursor: pointer; padding-left:10px;"></i>
                                                        </a>
                                                        <a data-toggle="modal"
                                                            data-target="#deleteAddrevenue{{ $id }}">
                                                            <i class="far fa-trash-alt"
                                                                style="cursor: pointer; padding-left:10px;"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="updateaddrevenue{{ $id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="p-5">
                                                                    <form action="{{route('updateADD',$id)}}" method="post">
                                                                        @csrf
                                                                    <div class="text-center">
                                                                        <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa cộng
                                                                            doanh số</h1>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="">Số tiền</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-user"
                                                                            id="price" name="price" value="{{ number_format($item['price']) }}" data-type="currency">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Nội dung</label>
                                                                        <textarea name="content"  rows="5"
                                                                            class="form-control "
                                                                            placeholder="Nội dung ">{!!$item['content']!!}</textarea>
                                                                    </div>
                                                                    <input type="hidden" id="user_id" name="user_id"
                                                                        value="{{ $item['user_id'] }}">
                                                                        <input type="hidden" id="token" value="{{$token}}">
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-primary"><a
                                                                                style="color: #fff;">Chỉnh sửa</a></button>
                                                                    </div>
                                                                </form>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteAddrevenue{{ $id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="p-5">
                                                                    <form action="{{route('deleteADD',$id)}}" method="post">
                                                                        @csrf
                                                                    <div class="text-center">
                                                                        <h1 class="h4 text-gray-900 mb-4">Bạn có muốn xóa không?</h1>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-primary"><a
                                                                                style="color: #fff;">Xóa</a></button>
                                                                    </div>
                                                                </form>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <?php $dem++; ?>
                                        @endforeach
                                        <?php } else {echo 'dữ liệu trống!';} ?>


                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                </div>
            </section>
            @endsection
           
    <script type="text/javascript">
     $("input[data-type='currency']").on('keyup', function() {
      var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            if (!isNaN(n)) $(this).val(n.toLocaleString());
            else $(this).val();
        });

    </script>


