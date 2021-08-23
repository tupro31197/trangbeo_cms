@extends('layouts.app')
@section('title-page', 'Đánh giá')
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
                            <h2 class="card-title">{{$dish}}</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover ">

                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ratings as $index => $rating)
                                        <tr>
                                            <th scope="row" style="vertical-align: middle ">{{ ++$index }}</th>
                                            <td style="vertical-align: middle ">{{ $rating['content'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Đánh giá</th>
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
@endsection
