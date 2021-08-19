@if (session('error'))
    <div class="col-xs-12  col-xs-12  col-md-12 col-lg-12  pd-0 pd-t-15">
        <div class="alert alert-danger mg-b-0 " role="alert">
            {{ session('error') }}
            <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
        </div>
    </div>
@endif
@if (session('success'))
    <div class="col-xs-12  col-xs-12  col-md-12 col-lg-12  pd-0 pd-t-15">
        <div class="alert alert-success mg-b-0 ">
            {{session('success')}}
            <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
        </div>
    </div>
@endif
