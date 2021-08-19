@extends('layouts.app')
@section('title-page', 'Danh sách các gói sữa')
@section('content')


    <section class="content">

                

                <div class="container">
                    <h1 class="text-center leader-title">Các gói Sữa</h1>
                    <div class="row" id="document">
                        @foreach ($packet as $item)

                            @php
                                $id = $item['id'];
                            @endphp
                            <div class="col-lg-4 clo-md-4">
                                <div class="card border-left-primary shadow text-center py-2 " style="margin:15px 10px;">
                                    <a href="{{ asset('chi-tiet-goi-sua/id=' . $id) }}" class="image_hover"><img src="{{ $item['image'] }}" alt=""
                                        style="height: 210px;
                                        width: 160px; object-fit:contain; transition: width 2s, height 2s"></a>
                                    <div>
                                        <a href="{{ asset('chi-tiet-goi-sua/id=' . $id) }}">
                                        <p style="padding-top: 10px; font-weight: bold; color:#000;">
                                            {!! $item['name'] !!}</p>
                                        <p class="name_doc">{!! $item['content'] !!}</p>
                                        </a>
                                        <div style="padding: 10px;">
                                            <p class="doc_down" style="float: left;">Giá: {{ number_format($item['price_from']) }}</p>
                                            <span>-</span>
                                            <p class="doc_down" style="float:right;">{{ number_format($item['price_to']) }} VNĐ</p>
                                        </div>
                                        <a href="{{ asset('dat-mua-sua/id='.$id) }}">
                                            <p class="btn btn-info">Mua</p>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

    </section>
    @endsection
    