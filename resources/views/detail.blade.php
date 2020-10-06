@extends('Layout/master')
@section('content')
<!-- <div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
</div> -->
@if(isset($product[0]))
<div class="container main_detail mt-5">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
                    <?php $image=$product[0]->imageupload;
                    $path='images/'.$image[0]->path;?>
                        <div> <a href="">@if(is_file(public_path($path)))<img src="{{URL::asset('images/'.$image[0]->path)}}">@else <img src="images/image-not-found.png" alt="">@endif </a></div>
                    </div> <!-- slider-product.// -->
                    <div class="img-small-wrap">
                    @foreach($image as $img)
                    <?php $path ='images/'.$img->path;?>
                    <div class="item-gallery">@if(is_file(public_path($path)))<img src="{{URL::asset('images/'.$img->path)}}">@else <img src="images/image-not-found.png" alt=""> @endif</div>
                    @endforeach


                </article> <!-- gallery-wrap .end// -->
            </aside>
            <aside class="col-sm-7">
                <article class="card-body p-5 text-justify">
                    <h3 class="title mb-3">{{$product[0]->product_name}}</h3>
                    <p class="price-detail-wrap">
                        <span class="price h3 text-warning">
                            <span class="currency"></span><span class="num">{{number_format($product[0]->price)}} đ</span>
                        </span>
                    </p> <!-- price-detail-wrap .// -->
                    <dl class="item-property">
                        <dt>Mô tả</dt>
                        <dd><p>{!!$product[0]->description!!}</p></dd>
                    </dl>
                    <dl class="param param-feature">
                        <dt>Tình Trạng</dt>
                        <dd>{{$product[0]->status}}</dd>
                    </dl>  <!-- item-property-hor .// -->
                    <dl class="param param-feature">
                        <dt>Bảo hành</dt>
                        <dd>{{$product[0]->warranty}}</dd>
                    </dl>  <!-- item-property-hor .// -->

                     <!-- <hr> -->
                    <!-- <div class="row">
                        <div class="col-sm-5">
                        <dl class="param param-inline">
                            <dt>Số lượng: </dt>
                             <dd>
                                <select class="form-control form-control-sm" style="width:70px;">
                                    <option> 1 </option>
                                    <option> 2 </option>
                                    <option> 3 </option>
                                </select>
                            </dd>
                        </dl>
                        </div>

                    </div>  -->
                    <hr>
                    <a href="{{route('product.checkout',['id'=>$product[0]->id])}}" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
                    <a href="{{url('/add-to-cart',['id'=>$product[0]->id])}}" class="btn btn-lg  text-uppercase pl-1"><i class="fa fa-shopping-cart"></i> Add to cart </a>
                </article> <!-- card-body.// -->
            </aside> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->
</div>
@else
<h3 class="text-center text-red" m-5>Sản phẩm hiện không còn kinh doanh</h3>
@endif
@endsection




