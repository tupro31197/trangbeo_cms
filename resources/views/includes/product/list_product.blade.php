@php
$totalPage = $response['data']['last_page'];
$currentPage = $response['data']['current_page'];

@endphp
@extends('layouts.app')
@section('title-page', 'Danh sách sản phẩm')
@section('content')


    <section class="content">


        <div class="container">
            <h1 class="text-center leader-title">Danh sách sản phẩm</h1>
            <div class="row" id="document">
                @foreach ($listProduct as $item)

                    @php
                        $id = $item['id'];
                    @endphp
                    <div class="col-lg-4 clo-md-4">
                        <div class="card border-left-primary shadow text-center py-2 " style="margin:15px 10px;">
                            <a href="{{ asset('chi-tiet-san-pham/id=' . $id) }}" class="image_hover"><img
                                    src="{{ $item['image'] }}" alt="" style="height: 210px;
                                                    width: 160px; object-fit:contain; transition: width 2s, height 2s"
                                    class="mt-1 "></a>
                            <div>
                                <a href="{{ asset('chi-tiet-san-pham/id=' . $id) }}">
                                    <p style="padding-top: 10px; font-weight: bold; color:#000; height:50px">
                                        {!! $item['name'] !!}</p>

                                </a>
                                <div class="text-center">
                                    <p>Giá:
                                        @if ($item['price_sale'] == null)
                                            <b>{{ number_format($item['price']) }} đ</b>

                                        @else <strike>{{ number_format($item['price']) }} đ </strike>
                                            <b> {{ number_format($item['price_sale']) }} đ </b>
                                        @endif
                                    </p>
                                </div>
                                <div class="text-center pb-3">
                                    {{-- <a href="{{ asset('them-gio-hang/' . $id) }}"> --}}
                                    <a onclick="addCart({{ $id }})" class="mr-5">
                                        <i class="fas fa-cart-plus fa-2x"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#copyLink{{$id}}">
                                        <i class="fas fa-link fa-2x"></i>
                                    </a>

                                    <div class="modal fade" id="copyLink{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chia sẻ sản phẩm</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Link sản phẩm:</label>
                                                    <input type="text" id="link_share_product{{$id}}" class="form-control form-control-user" name="content_payment" value="{{ asset('dat-hang-san-pham?id=' .$id) .'&key=' .base64_encode($infor['cmt']) }}" readonly>
                                                </div>
                                                
                                                
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                                    <button style="background: #fff;border: none;" type="submit" onclick="copytext({{ $id }})"><a class="btn btn-info">Copy</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            {{-- ======= phân trang ======== --}}
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="{{ asset('danh-sach-san-pham/1') }}">Đầu</a>
                </li>

                @if ($currentPage - 1 >= 1)
                    <li class="page-item"><a class="page-link"
                            href="{{ asset('danh-sach-san-pham/' . ($currentPage - 1)) }}"> <i
                                class="fas fa-angle-left"></i></a></li>
                @endif
                @if ($currentPage - 1 >= 1)
                    <li class="page-item"><a class="page-link"
                            href="{{ asset('danh-sach-san-pham/' . ($currentPage - 1)) }}">{{ $currentPage - 1 }}</a>
                    </li>
                @endif
                <li class="page-item {{ 'active' }}"><a class="page-link"
                        href="{{ asset('danh-sach-san-pham/' . $currentPage) }}">{{ $currentPage }}</a>
                </li>
                @if ($currentPage + 1 <= $totalPage)
                    <li class="page-item "><a class="page-link"
                            href="{{ asset('danh-sach-san-pham/' . ($currentPage + 1)) }}">{{ $currentPage + 1 }}</a>
                    </li>
                @endif
                {{-- @endfor --}}
                @if ($currentPage + 1 <= $totalPage)
                    <li class="page-item"><a class="page-link"
                            href="{{ asset('danh-sach-san-pham/' . ($currentPage + 1)) }}"> <i
                                class="fas fa-angle-right"></i></a></li>
                @endif
                <li class="page-item"><a class="page-link"
                        href="{{ asset('danh-sach-san-pham/' . $totalPage) }}">Cuối</a></li>
            </ul>
            {{-- ==========hết phân trang ============ --}}

        </div>
    </section>
    @include('layout/footer')
@endsection



<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script>
   
   function copytext(id) {
        var copyText = document.getElementById("link_share_product" + id);
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

    function addCart(id) {
    var url = '{{ asset("them-gio-hang/") }}';
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'html',
        data: {
            id: id,

        },

        success: function(data) {
            console.log(data);

            if (data == 0) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,

                });
                Toast.fire({
                    type: 'error',
                    title: 'Thêm giỏ hàng thất bại!'
                })
            } else {
                $("#cart_total").html(data);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,

                });
                Toast.fire({
                    type: 'success',
                    title: 'Thêm giỏ hàng thành công!'
                })
            }
        },

        error: function() {
            alert(0);
        }

    })
}
</script>
