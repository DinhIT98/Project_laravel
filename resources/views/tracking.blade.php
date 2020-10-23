@extends('Layout/master')
@section('content')
<link href="{{ URL::asset('css/tracking.css')}}" rel="stylesheet">
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" rel="stylesheet"> -->
<!-- <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet"> -->
@if(isset($data))
<div class="container">
    <article class="card">
        <!-- <header class="card-header"> My Orders / Tracking </header> -->
        <div class="card-body">
            <h6 style="padding-left:10px; font-size:16px" >Mã đơn hàng: {{$data->id}}</h6>
            <article class="card ">
                <div class="card-body row ">
                    <div class="col-sm-3" style="padding-left:25px"> <strong >Thời gian nhận hàng dự kiến:</strong> <br>29 nov 2019 </div>
                    <div class="col-sm-3"> <strong>Đơn vị vận chuyển:</strong> <br>Giao hàng tiết kiệm: <i class="fa fa-phone"></i>0223959697</div>
                    <div class="col-sm-3"> <strong>Trạng thái:</strong> <br>{{$data->status}}</div>
                    <div class="col-sm-3"> <strong>Mã vận chuyển:</strong> <br> BD045903594059 </div>
                </div>
            </article>
            <div class="track">
                @switch($data->status)
                    @case('Mới đặt hàng')
                        <div class="step active "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Mới đặt hàng</span> </div>
                        <div class="step "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Chưa giao hàng</span> </div>
                        <div class="step  "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                        <div class="step "> <span class="icon"> <i class="far fa-box"></i> </span> <span class="text">Giao hàng thành công</span> </div>
                        @break
                    @case('Chưa giao hàng')
                        <div class="step active "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Mới đặt hàng</span> </div>
                        <div class="step active "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Chưa giao hàng</span> </div>
                        <div class="step  "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                        <div class="step "> <span class="icon"> <i class="far fa-box"></i> </span> <span class="text">Giao hàng thành công</span> </div>
                        @break
                    @case('Đang giao hàng')
                        <div class="step active "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Mới đặt hàng</span> </div>
                        <div class="step active "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Chưa giao hàng</span> </div>
                        <div class="step active  "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                        <div class="step "> <span class="icon"> <i class="fas fa-box-open"></i> </span> <span class="text">Giao hàng thành công</span> </div>
                        @break
                    @case('Giao hàng thành công')
                        <div class="step active "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Mới đặt hàng</span> </div>
                        <div class="step active "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Chưa giao hàng</span> </div>
                        <div class="step active  "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                        <div class="step active"> <span class="icon"><i class="fas fa-box-open"></i> </span> <span class="text">Giao hàng thành công</span> </div>
                        @break
                @endswitch
            </div>
            <hr>
            <ul class="row overflow-auto">
                @foreach($data->order_detail as $detail)
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="{{asset('images/'.$detail->product_image)}}" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">{{$detail->product_name}} <br></p> <span class="text-muted">{{number_format($detail->product_price)}}</span>
                        </figcaption>
                    </figure>
                </li>
                @endforeach

            </ul>
            <hr>
            <a href="/" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to home</a>
        </div>
    </article>
</div>
@else
<div class="container">
    <section class="content-header"></section>
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h4 class="text-center">Chưa có đơn hàng nào được đặt </h4>
            </div>
            <div class="card-body">
            <a href="/" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to home</a>
            </div>
        </div>
    </section>
</div>
@endif
@endsection
