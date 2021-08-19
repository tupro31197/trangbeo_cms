<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Chia sẻ sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&family=Quicksand:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Style+Script&family=WindSong:wght@500&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/LineIcons.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <!--====== Aos css ======-->
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <!--====== Slick css ======-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">


    <!--====== Default css ======-->
    <link rel="stylesheet" href=" {{ asset('/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body>
    {{-- <div class="preloader">
        <div class="loader_34">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <header id="home" class="header-area pt-100">


        <div class="navigation-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="{{ asset('img/logo2.png') }}" alt="Logo">
                                <span class="logo-landing pl-2">HEALTHMOOMY</span>
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#introduce">Giới thiệu</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#product">Sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#order">Mua hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#promotion">Cảm nhận</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#footer">Liên hệ</a>
                                    </li>

                                </ul> <!-- navbar nav -->
                            </div>
                            <div class="navbar-btn ml-20 d-none none d-sm-block">
                                <a class="main-btn" href="#">Hotline: {{ $ctv['phone'] }}</a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navigation bar -->

        <div class="header-banner d-flex align-items-center">
            <div class="container-fuild">


                {{-- <div class="banner-content"> --}}
                {{-- <h4 class="sub-title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">Your trusted</h4>
                            <h1 class="banner-title mt-10 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="2s"><span>Interior</span> Design Partner for Home or Office</h1>
                            <a class="banner-contact mt-25 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="2.3s" href="#contact">Get a Free Quote</a> --}}
                {{-- <img src="{{ asset('img/banner.png') }}" alt=""> --}}
                <div id="demo" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner ">
                        @if (isset($detailProduct['product_slider']) && $detailProduct['product_slider'] != null)
                     
                            @foreach ($detailProduct['product_slider'] as $key => $item)
                                <div class="text-center carousel-item @if ($key==0) {{ 'active' }} @endif">
                                    <a href="{{ $item['link'] }}"> <img src="{{ $item['image'] }}"
                                            alt="Healthmoomy" class="d-block w-100"></a>
                                </div>
                            @endforeach
                        @elseif( isset($slider) && $slider !=null)
                        
                            @foreach ($slider as $key=>$item)
                            {{-- {{ dd($item)}} --}}
                            <div class="text-center carousel-item @if ($key==0) {{ 'active' }} @endif">
                                <a href="{{ $item['link'] }}"> <img src="{{ $item['image'] }}"
                                        alt="Healthmoomy" class="d-block w-100"></a>
                            </div>
                            @endforeach
                        @endif


                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
                {{-- </div> <!-- banner content --> --}}


            </div> <!-- container -->
        </div>
        </div> <!-- header banner -->

    </header>

    <!--====== HEADER PART ENDS ======-->

    <!--====== ABOUT PART START ======-->
    @if (isset($detailProduct['product_question']) && $detailProduct['product_question'] != null)
        <section id="introduce" class="about-area pt-50 pb-50">
            <div class="container">

                <div class="about-content mt-45">
                    <h4 class="about-welcome color-red text-center">Có thể bạn đang gặp những vấn đề? </h4>
                    <div class="row">
                        <div class="col-md-5 col-12 " style="flex-direction: column;
                    justify-content: center;
                    display: flex;">
                            @foreach ($detailProduct['product_question'] as $key => $item)
                                @if ($key <= 4)
                                    <div class="pt-3 d-flex">
                                        <img src="{{ asset('img/iconx.png') }}" alt="" width="25px" height="25px">
                                        <span class="pl-2"><b>{{ $item['content'] }}</b></span>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="col-md-7 col-12 none">
                            <div class="row">
                                @php
                                    $item = $detailProduct['product_question'];
                                @endphp
                                <div class="col-md-4">
                                    <img src="@if (isset($item[0]['image']) && $item[0]['image']
                                    !='' ) {{ $item[0]['image'] }} @else {{ asset('img/image_girl2.png') }} @endif" alt=""
                                        style="width: 100%; position: relative;transform: translateY(50%);height: 200px;">
                                </div>
                                <div class="col-md-5">
                                    <img src="@if (isset($item[1]['image']) && $item[1]['image']
                                    !='' ) {{ $item[1]['image'] }} @else {{ asset('img/image_girl2.png') }} @endif" alt="" class="image-landing1">
                                    <img src="@if (isset($item[2]['image']) && $item[2]['image']
                                        !='' ) {{ $item[2]['image'] }} @else{{ asset('img/image_girl2.png') }} @endif" alt="" class="image-landing1">
                                </div>
                                <div class="col-md-3" style="transform: translateY(12%)">
                                    <img src="@if (isset($item[3]['image']) && $item[3]['image']
                                        !='' ) {{ $item[3]['image'] }} @else{{ asset('img/image_girl2.png') }} @endif" alt="" class="image-landing2">
                                    <img src="@if (isset($item[4]['image']) && $item[4]['image']
                                        !='' ) {{ $item[4]['image'] }} @else{{ asset('img/image_girl2.png') }} @endif" alt="" class="image-landing2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- about content -->

            </div> <!-- container -->
        </section>
    @endif
    <!--====== ABOUT PART ENDS ======-->

    <!--====== SERVICES PART START ======-->
    {{-- {{ dd($detailProduct)}} --}}
    @if (isset($detailProduct['product_content']) && $detailProduct['product_content'] != null)
        <section id="product" class="services-area pt-50 pb-50 gray-bg">
            <div class="container">
                <div class="row ">
                    <div class="col-md-6 col-12 ">
                        <div>
                            <h5 class="color-red" style="text-transform: uppercase">
                                {{ $detailProduct['product_content'][0]['title'] }}</h5>
                            <p class="color-red"><b>{{ $detailProduct['product_content'][0]['description'] }}
                                </b></p>
                            <hr class="color-red w-50">
                            <p class="color-black" style="font-size: 15px;">
                                {!! $detailProduct['product_content'][0]['content'] !!}</p>
                        </div>


                    </div>
                    <div class="col-md-6 col-12">
                        <img src="{{ asset('img/frame.png') }}" alt="">
                    </div>

                </div> <!-- row -->
            </div> <!-- container -->
        </section>
    @endif

    <!--====== SERVICES PART ENDS ======-->

    <!--====== PROJECT PART START ======-->
    @if (isset($detailProduct['product_advantage']) && $detailProduct['product_advantage'] != null)

    <section id="project" class="project-area pt-50 pb-50">
        <div class="container text-center pb-20">
            <h4 class="color-red">TÁC DỤNG CỦA</h4>
            <h3 class="pt-10">{{ $detailProduct['name'] }}</h3>

        </div>
        <div class="container">
            <div class="row pt-3">
                @foreach ($detailProduct['product_advantage'] as $key=>$item)
                <div class="col-md-4 col-12 pt-20">
                    <div class="row">
                        <div class="col-md-2 col-3">
                            <img src="{{ asset('img/square.png') }}" width="50px" alt="">
                            <p class="text-center text-image"><b>{{ ++$key }}</b></p>
                        </div>
                        <div class="col-md-10 col-9 pr-3">
                            <p class="text-a"><b>{{ $item['content']}}</b></p>
                            {{-- <p class="pt-2 text-b">Cung cấp nguồn dinh dưỡng thiết yếu, phù hợp với những người ăn
                                kiêng, ăn chay không phải ăn quá nhiều mà vẫn đủ chất.</p> --}}
                        </div>
                    </div>
                </div>
                @endforeach
                
                
                
            </div>
        
        </div>
    </section>
    @endif

    <!--====== PROJECT PART ENDS ======-->

    <!--====== TEAM PART START ======-->
    @if (isset($detailProduct['product_video'][0]) && $detailProduct['product_video'][0] != '')
        <section id="service" class="services-area pt-50 pb-50 gray-bg height-300">
            <div class="container">
                <div class="row ">
                    <div class="col-md-7 col-12 ">
                        <div class="text-center">
                            @php
                                $linkvd = $detailProduct['product_video'][0]['video'];
                                $check = substr($linkvd, 0, 5);
                                // dd($check);
                                if ($check == 'https') {
                                    $num = 32;
                                } else {
                                    $num = 31;
                                }
                                $url = substr($linkvd, $num);
                                // dd($url);
                            @endphp
                            <iframe width="90%" height="315" src="https://www.youtube.com/embed/{{ $url }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>


                    </div>
                    <div class="col-md-5 col-12">
                        <div>
                            <h4 class="color-red pt-10" style="text-transform: uppercase">
                                {{ $detailProduct['product_video'][0]['title'] }}</h4>
                            <p class="color-red"><b>{{ $detailProduct['product_video'][0]['content'] }}
                                </b></p>
                            <hr class="color-red w-50">
                            <a class="page-scroll" href="#order"><button class="btn btn-warning color-red"><b>Đặt hàng
                                        ngay</b></button></a>
                        </div>
                    </div>

                </div> <!-- row -->
            </div> <!-- container -->
        </section>
    @endif

    <!--====== TEAM PART ENDS ======-->


    <!--====== CONTACT PART START ======-->

    <section id="order" class="project-area mt-10 pt-100 pb-50">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-6 col-12  gray-bg text-center">
                    <h4 class="color-red pt-40">MUA NGAY BÂY GIỜ</h4>
                    <p class="color-red">DUY NHẤT TRONG NGÀY HÔM NAY <span id="today">10/08/2021</span></p>
                    <p style="font-family: 'WindSong', cursive; font-size: 30px" class="pt-10 pb-10">Giá bán</p>
                    <h2 class="text-danger">
                        @if (isset($detailProduct['price_sale']) && $detailProduct['price_sale'] != null)
                            {{ number_format($detailProduct['price_sale']) }}
                        @else {{ number_format($detailProduct['price']) }}
                        @endif VNĐ/HỘP
                    </h2>
                    <div class="row pt-20 pb-20">
                        <div class="col-md-2 col-1"></div>
                        <div class="col-2">
                            <div class="color-bg text-white">
                                <h2 class="text-white" id="hours">11</h2>
                                <p>Hr</p>
                            </div>
                        </div>
                        <div class="col-1">
                            <p class="color-red" style="font-size: 20px"><b>:</b></p>
                        </div>
                        <div class="col-2 ">
                            <div class="color-bg text-white">
                                <h2 class="text-white" id="minutes">11</h2>
                                <p>Min</p>
                            </div>
                        </div>
                        <div class="col-1">
                            <p class="color-red" style="font-size: 20px"><b>:</b></p>
                        </div>
                        <div class="col-2">
                            <div class="color-bg text-white">
                                <h2 class="text-white" id="seconds">11</h2>
                                <p>Sec</p>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="text-left ml-50 mr-50">
                        <form action="{{ asset('dat-hang') }}" method="post">
                            @csrf
                            <div class="mb-20">
                                <label for="">Họ tên:</label>
                                <input type="text" name="name_user" class="form-control" placeholder="Họ tên ...">
                            </div>
                            <div class="mb-20">
                                <label for="">Số điện thoại:</label>
                                <input type="number" name="phone_order" class="form-control"
                                    placeholder="Số điện thoại ...">
                            </div>
                            <div class="mb-20">
                                <label for="">Địa chỉ:</label>
                                <input type="text" name="address_order" class="form-control" placeholder="Địa chỉ ...">
                            </div>
                            <div class="mb-20">
                                <label for="">Số lượng:</label>
                                <input type="number" name="number" class="form-control" placeholder="Số lượng ...">
                                <input type="number" name="cmt" class="form-control" hidden
                                    value="{{ $cmt }}">
                                <input type="text" name="product_id" value="{{ $detailProduct['id'] }}"
                                    class="form-control" readonly hidden>
                            </div>
                            <div class="mb-20">
                                <label for="">Nội dung:</label>
                                <input type="text" name="content" class="form-control" placeholder="Nội dung ...">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-warning color-red" type="submit"><b>Đặt hàng nhận ưu
                                        đãi</b></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <img src="{{ $detailProduct['image'] }}" alt="" style="width: 80%;
                    margin: 0 auto;
                    display: block;
                    object-fit: fill;">
                    @if (isset($detailProduct['product_promotion']) && $detailProduct['product_promotion'] != '')
                        <h4 class="color-red pt-40 ml-2">KHUYẾN MÃI HÔM NAY</h4>
                        @foreach ($detailProduct['product_promotion'] as $item)
                            <div class="m-3 d-flex">
                                <img src="{{ asset('img/tick.png') }}" alt="" width="25px" height="25px">
                                <span class="pl-10">{{ $item['title'] }}</span>
                            </div>
                        @endforeach


                    @endif
                </div>

            </div>

        </div>
    </section>

    <!--====== CONTACT PART ENDS ======-->
    <section id="service" class="services-area pt-50 pb-50">
        <div class="container">
            <div class="row ">
                <div class="col-md-6 col-12 ">
                    <div>
                        <h5 class="color-red" style="text-transform: uppercase">{{ $detailProduct['name'] }}</h5>
                        <p class="color-red"><b>Những nguồn dinh dưỡng quý giá từ thiên nhiên
                            </b></p>
                        <hr class="color-red w-50">
                        <p class="color-black" style="font-size: 15px;">
                            {!! $detailProduct['content'] !!}
                        </p>
                    </div>


                </div>
                <div class="col-md-6 col-12">
                    <img src="{{ asset('img/view_default.png') }}" alt="">
                </div>

            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    @if (isset($detailProduct['product_content2']) && $detailProduct['product_content2'] != null)
        <section id="service" class="services-area pt-50 gray-bg" style="height: 90%">
            <div class="container">
                <div class="row ">
                    <div class="col-md-5 col-12 ">
                        {{-- {{ dd($detailProduct)}} --}}
                        <div class="slick_image">
                            @foreach ($detailProduct['product_content2'] as $key=>$item)
                            <img src="{{ $item['image'] }}" alt="" width="90%"  @if ($key==0){{ "active"}}
                                
                            @endif>

                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-7 col-12">

                        <div class="p-3">
                            <h5 class="color-red" style="text-transform: uppercase">Ưu thế vượt trội của
                                {{ $detailProduct['name'] }}</h5>
                            <p class="color-red"><b>So với các sản phẩm khác đang bán trên thị trường.
                                </b></p>
                            <hr class="color-red w-50">

                            <div class="row text-justify">
                                @foreach ($detailProduct['product_content2'] as $item)


                                    <div class="col-md-6 col-12 p-2 prior">
                                        <li>
                                            {!! $item['content'] !!}

                                        </li>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                </div> <!-- row -->
            </div> <!-- container -->
        </section>
    @endif

    @if (isset($detailProduct['product_recommend']) && $detailProduct['product_recommend'] != null)
        <section id="project" class="project-area pt-50 pb-50">
            <div class="container text-center pb-20">
                <h4 class="color-red">BÁO CHÍ VÀ NGƯỜI NỔI TIẾNG NÓI GÌ VỀ SẢN PHẨM?</h4>

            </div>
            <div class="container">
                <div class="row  pt-3 slick">
                    @foreach ($detailProduct['product_recommend'] as $item)
                        <div class="col-md-4 col-12">
                            <img src="{{ $item['image'] }}" alt="" class="p-2" style="width:100%; height: 300px">
                            <div class="text-center"><a href="{{ $item['link']}}"><button class="btn btn-warning color-red">Xem thêm</button></a>
                            </div>
                            </div>
                    @endforeach



                </div>

            </div>
        </section>
    @endif

    <section id="service" class="services-area pt-50" style="height: 90%">
        <div class="container-fuild">
            <div class="row ">
                <div class="col-md-6 col-12 " style="background: #FF6595; ">
                    <div class="image-introduce">
                        <img src="{{ $ctv['image'] }}" alt="" style="width: 400px;
                    height: 350px;">
                        <h4 class="text-white  pt-10 pb-10">
                            CTV {{ $ctv['name'] }}
                        </h4>
                        {{-- <p class="text-white" style="font-size: 13px">Nhà sáng lập, trưởng ban tổ chức cuộc thi Hoa hậu
                            Doanh nhân Việt Nam Quốc Tế
                        </p> --}}
                    </div>
                </div>
                <div class="col-md-6 col-12 gray-bg">

                    <div class="text-introduce p-3">

                        @if ($ctv['description'] != null)<span
                                style="font-size: 15px">{{ $ctv['description'] }}</span>
                            <br>
                        @else <span style="font-size:15px">Healthmoomy chuyên phân phối các dòng sản phẩm dinh dưỡng
                                cho mẹ bầu và bé. Để
                                đảm bảo dương chất đầy đủ cho mẹ và bé thì cần những vi chất cần thiết như đạm, kẽm, máu
                                để mẹ và bé có sức khỏe tốt nhất</span>
                        @endif


                    </div>
                </div>

            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    @if(isset($detailProduct['product_video']) && $detailProduct['product_video'] != null)
    <section id="project" class="project-area pt-50 pb-100">

        <div class="container text-center pb-20">
            <h4 class="color-red" style="text-transform: uppercase">VIDEO CHIA SẺ CẢM NHẬN SAU KHI DÙNG
                {{ $detailProduct['name'] }}</h4>

        </div>
        <div class="container slick_video text-center  " style="height: 315px; width: 70%">
            @foreach ($detailProduct['product_video'] as $item)
                @php
                    $linkvd = $item['video'];
                    $check = substr($linkvd, 0, 5);
                    // dd($check);
                    if ($check == 'https') {
                        $num = 32;
                    } else {
                        $num = 31;
                    }
                    $url = substr($linkvd, $num);
                    // dd($url);
                @endphp

                <iframe width="70%" style="height:315px" src="https://www.youtube.com/embed/{{ $url }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>


            @endforeach
        </div>
    </section>
    @endif

    @if (isset($detailProduct['product_feel']) && $detailProduct['product_feel'] != null)
        <section id="promotion" class="project-area pb-70">
            <div class="container text-center pb-20">
                <h4 class="color-red">KHÁCH HÀNG CHIA SẺ CẢM NHẬN SAU KHI DÙNG HEALTHMOOMY</h4>

            </div>
            <div class="container text-center">
                <div class="row ">
                    @foreach ($detailProduct['product_feel'] as $item)
                        <div class="col-md-6 col-12">
                            <div class="row pb-20">
                                <div class="col-5">
                                    <img src="{{ $item['avatar'] }}" alt="" width="100%" height="200px">
                                </div>
                                <div class="col-7 text-justify">
                                    <h5 class="color-red" style="text-transform: uppercase">{{ $item['name'] }}</h5>
                                    <p><b>{{ $item['age_location'] }}</b></p>
                                    <p style="font-size: 14px;line-height: 19px;">
                                        {!! $item['content'] !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section id="project" class="project-area pb-50 ">
        <div class="container text-center pb-20">
            <h3 class="color-red">HEALTHMOOMY </h3>
            <h4 class="pt-10">Liệu pháp chăm sóc sức khoẻ sắc đẹp bên trong</h4>

        </div>
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-6 col-12 text-center">
                    <img src="{{ $detailProduct['image'] }}" alt="" style="max-height:400px">
                </div>
                <div class="col-md-6 col-12  gray-bg text-center">
                    <h4 class="color-red pt-40">MUA NGAY BÂY GIỜ</h4>
                    <p class="color-red">DUY NHẤT TRONG NGÀY HÔM NAY <span id="today"></span></p>
                    <p style="font-family: 'WindSong', cursive; font-size: 30px" class="pt-10 pb-10">Giá bán</p>
                    <h2 class="text-danger">
                        @if (isset($detailProduct['price_sale']) && $detailProduct['price_sale'] != null)
                            {{ number_format($detailProduct['price_sale']) }}
                        @else {{ number_format($detailProduct['price']) }}
                        @endif VNĐ/HỘP
                    </h2>

                    <div class="text-center pt-20">
                        <a class="page-scroll" href="#order"><button class="btn btn-warning color-red"><b>Đặt hàng
                                    ngay</b></button></a>

                    </div>
                    <p class="pt-20 pb-10">Hân hạnh đem lại sản phẩm tốt cho sức khoẻ của bạn.</p>
                </div>
            </div>

        </div>
    </section>

    <section id="footer" class="project-area color-bg2">
        <div class="container-fuild pt-70 pb-50">
            <div class="row pt-3 text-center ">
                <div class="col-md-6 col-12 text-center">
                    <div class="color-bg-yellow mt-10 mb-20 pt-10 pb-10">
                        <h4 class="color-red">TUYỂN DỤNG ĐẠI LÝ TOÀN QUỐC</h4>
                        <p class="color-red" style="font-size: 14px"><b>Kinh doanh thành công cùng HEALTHMOOMY ngày hôm
                                nay</b></p>
                    </div>
                    <div>
                        <img src="{{ $ctv['image'] }}" alt=""
                            style="border-radius: 100px; width: 200px; height: 200px" class="mt-10 mb-10">
                        <h3 class="text-white" style="text-transform: uppercase">{{ $ctv['name'] }}</h3>
                        {{-- <p class="text-white"><b>CEO - Công ty TNhh xuất nhập khẩu nắng thu</b></p> --}}
                    </div>
                    <div class="text-left" style="padding: 10px 20%">
                        <div class="pb-10 " style="display:flex">
                            <img width="20px" height="20px" src="{{ asset('img/house.png') }}" alt="">
                            <span class="text-white pl-10" style="font-size: 13px">Địa chỉ:
                                {{ $ctv['address'] }}</span>
                        </div>
                        <div class="pb-10" style="display: flex">
                            <img width="20px" height="20px" src="{{ asset('img/phone.png') }}" alt="">
                            <span class="text-white pl-10" style="font-size: 13px"> Điện thoại:
                                {{ $ctv['phone'] }}</span>
                        </div>
                        <div class="pb-10" style="display:flex">
                            <img width="20px" height="20px" src="{{ asset('img/phone2.png') }}" alt="">
                            <span class="text-white pl-10" style="font-size: 13px">Hotline:
                                {{ $ctv['phone'] }}</span>
                        </div>
                        <div class="pb-10">
                            <span class="text-white" style="font-size: 13px">Liên hệ ngay với chúng tôi hoặc liên hệ
                                hotline: {{ $ctv['phone'] }} để được tư vấn</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 text-center">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.0513014146027!2d105.78172821479363!3d20.990580586019053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acb5625258df%3A0xe5edea9228785170!2sNGUY%E1%BB%84N%20QUANG%20PIANO!5e0!3m2!1svi!2s!4v1628848301657!5m2!1svi!2s"
                        width="80%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a href="{{ asset('dang-ki?key=' . base64_encode($ctv['cmt'])) }}"><button class="btn btn-warning color-red mt-40"><b>ĐĂNG KÝ LÀM CTV</b></button>
                </div>
            </div>

        </div>
    </section>



    <a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>


    <!--====== jquery js ======-->
    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!--====== WOW js ======-->
    <script src="{{ asset('js/wow.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="{{ asset('js/scrolling-nav.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!--====== Aos js ======-->
    <script src="{{ asset('js/aos.js') }}"></script>


    <!--====== Main js ======-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @include('sweetalert::alert')

</body>

</html>
