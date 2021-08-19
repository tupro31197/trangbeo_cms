@extends('layouts.app')
@section('title-page', 'Thông báo')
@section('content')


    <section class="content">


                <div class="container">
                   
                <h6 class="dropdown-header">
                    Thông báo !
                </h6>
                @foreach ($listdata['list_notify']['data'] as $item)
                @php
                    if ($item['is_view'] == 1) {
                        $class = '';
                    } else {
                        $class = 'font-weight-bold';
                     }
                @endphp
                <div class="card mb-0">
                <form action="{{ route('notify') }}" method="post" >
                    @csrf
                    <button class="dropdown-item d-flex align-items-center" type="submit">
                        <input type="hidden" value="{{ $item['id'] }}" name="notify_id" id="{{ $item['id'] }}">
                        <div class="mr-3">
                            <div class="icon-circle">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{$item['created_at']}}</div>
                            <span class="{{$class}}">{!!$item['content']!!}</span>
                        </div>
                    </button>
                </form>
                </div>
                <br>
                @endforeach
                
            </div>

                    @php
                    if (isset($listdata)) {
                        $page = $listdata['list_notify']['current_page'];
                    } else {
                        $page = $listdata['list_notify']['current_page'];
                    }
                @endphp
                

        <ul class="pagination mt-4 mr-3" >
        
            @if ($page > 1)
                <li class="page-item mr-2"><a style="color: #4e73df" class="page-link"
                        href="{{ asset('thong-bao/page=' . ($page - 1)) }}">
                        <i class="fas fa-angle-left"></i></a>
                </li>
            @endif
            @for ($i = $page - 1; $i <= $page + 1; $i++)

                @if ($i > 0 && $i <= $listdata['list_notify']['last_page']) <li class="page-item mr-2"><a href="{{ asset('thong-bao/page=' . $i) }}"
                                            class="page-link         @if ($page==$i)
                {{ 'pagActive' }} @else {{ 'pagNoActive' }} @endif"
                    href="#">{{ $i }}</a></li>
            @endif

            @endfor
            @if ($page < $listdata['list_notify']['last_page'])
                <li class="page-item mr-2"><a style="color: #4e73df" class="page-link"
                        href="{{ asset('thong-bao/page=' . ($page + 1)) }}">
                        <i class="fas fa-angle-right"></i></a>
                </li>
            @endif

        </ul>
    </section>
      
 @endsection



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    
