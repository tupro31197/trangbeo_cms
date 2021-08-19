@extends('layouts.app')
@section('title-page', 'Chi tiết gói sữa')
@section('content')


    <section class="content">

         
                <div class="container card">
                    @php
                        $id = $packetdetail['id'];
                    @endphp
                    <h1 class="text-center leader-title">{{$packetdetail['name']}}</h1>
                
                            
                                    <div class="thumbnail document_total text-center" style="margin:0 10px;">
                                        <img src="{{ $packetdetail['image'] }}" alt=""
                                            style="border-top-left-radius:10px;border-top-right-radius:10px; height: 210px;">
                                        <div>
                                            <p style="text-align: center;padding: 20px 0 0 20px;">{!!$packetdetail['content']!!}</p>
                                            <div style="padding: 0 20px;">
                                                <p class="doc_down" style="text-align: center;">Giá: {{number_format($packetdetail['price_from'])}}<span>-</span>
                                                <span >{{number_format($packetdetail['price_to'])}} VNĐ</span></p>
                                            </div>
                                            <a href="{{ asset('dat-mua-sua/id='.$id) }}"><p class=" btn btn-info  ">Mua</p></a>
                                        </div>

                                    </div>
                

  
                </div>

           

            </section>

@endsection

  