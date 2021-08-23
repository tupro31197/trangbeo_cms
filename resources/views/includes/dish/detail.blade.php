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
                                    <th class="col-md-3 col-3">Danh mục</th>
                                    <td class="col-md-9 col-9"> {{ $content['category']['name'] }}</td>

                                </tr>
                                <tr class="row">
                                    <th class="col-md-3 col-3">Người đăng</th>
                                    <td class="col-md-9 col-9"> {{ $content['user']['name'] }}</td>

                                </tr>
                                <tr class="row">
                                    <th class="col-md-3 col-3">Người duyệt</th>
                                    <td class="col-md-9 col-9">@if($content['status']==2) {{ $content['reviewer']['name'] }} @endif</td>

                                </tr>
                     
                                <tr class="row">
                                    <th class="co-md-3 ">Ảnh bài viết: </th>
                                    <td class="col-md-9 row" id="copyimage">
                                        @foreach ($content['list_image'] as $image)
                                            <div class="col-md-3 col-12 text-center mb-2 ">

                                                <img src="{{ $image['image'] }}" alt=""
                                                    style="width: 180px; height:200px">
                                            </div>
                                        @endforeach

                                    </td>
                                </tr>
                                <tr class="row">
                                    <th class="col-md-3">Nội dung</th>
                                    <td class="col-md-9">
                                        <div id="copy"> {!! $content['content'] !!}</div>
                                    </td>

                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center"><button class="btn btn-primary" onclick="copy('#copy')">Copy bài viết</button>
                                    </th>
                                    {{-- <th><button class="btn btn-primary" onclick="copyimage('copyimage')">Copy hình
                                            ảnh</button> </th> --}}

                                </tr>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

    </section>
    @endsection



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layout/libjs')
    <script>
        function copy(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            swal({
                title: 'Copied!',
                text: '',
                timer: 1500,
                type: 'success'
            });
        }

        function copyimage(Id) {
            var imgs = document.createElement('img');
            imgs.src = document.getElementById(Id).src;

            //alert ('Create image') ;

            var bodys = document.body;
            bodys.appendChild(imgs);
            //alert ('Image on document')


            if (document.createRange) {
                //alert ('CreateRange work');
                var myrange = document.createRange();
                myrange.setStartBefore(imgs);
                myrange.setEndAfter(imgs);
                myrange.selectNode(imgs);

            } else {
                alert('CreateRange NOT work');
            }


            var sel = window.getSelection();
            sel.addRange(myrange);
            var successful = document.execCommand('copy');

            bodys.removeChild(imgs);

        }
    </script>
</body>

</html>
