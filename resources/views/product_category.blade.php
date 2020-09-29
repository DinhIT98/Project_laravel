@extends('Layout/master')
@section('content')
<div id="home">
		<div class="container">
			<section id="featured">
				<div class="hidden-xs col-sm-4 col-md-3">
					<div class="boxleft">
						<div class="titboxl">
							<i class="fa fa-bars fa-x2 fa-lg" aria-hidden="true"></i>
							<span>Danh mục sản phẩm</span>
						</div>
						<div class="ctboxleft">
							<ul class="mnboxl">

                            @foreach($category_1 as $cate_1)
								<li>
									<a href="{{route('show.category',['cate'=>$cate_1->id])}}">{{$cate_1->name}}</a>
                                    <ul class="mnboxl_1">
                                    @foreach($category_2 as $cate_2)
                                        @if($cate_1->id == $cate_2->parent_id)
										<li><a href="">{{$cate_2->name}}</a></li>
                                        @endif
                                    @endforeach
                                    </ul>
								</li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9">
					<div class="slider-wrapper theme-default">
			            <div id="slider" class="nivoSlider">
			                <a href=""><img src="{{URL::asset('images/slide3.png')}}" alt="" /></a>
			                <a href=""><img src="{{URL::asset('images/slide4.png')}}" alt="" /></a>
                            <a href=""><img src="{{URL::asset('images/slide5.png')}}" alt="" /></a>
			            </div>
			        </div>
				</div>
				<div class="banner clearfix">
					<div class="col-xs-12 col-sm-6">
						<img src="" alt="">
					</div>
					<div class="col-xs-12 col-sm-6">
						<img src="" alt="">
					</div>
				</div>
			</section>
			<section id="main">
				<div id="left" class="col-xs-12 col-sm-4 col-md-3">
					<div class="boxleft visible-xs">
						<div class="titboxl dmspmobi">
							<i class="fa fa-bars fa-x2 fa-lg" aria-hidden="true"></i>
							<span>Danh mục sản phẩm</span>
						</div>
						<div class="ctboxleft">
							<ul class="ulspmobi">
								<li>
									<a href="">Phụ kiện Iphone</a>
									<span class="iconlist">icon</span>
									<ul class="mnboxl_1">
										<li><a href="">Củ sặc Iphone</a></li>
										<li><a href="">Cáp sặc Iphone</a></li>
										<li><a href="">Phụ kiện Ipad</a></li>
									</ul>
								</li>
								<li><a href="">Phụ kiện SamSung</a></li>
								<li><a href="">Phụ kiện LG HTC</a></li>
								<li><a href="">Phụ kiện Nokia Sky</a></li>
								<li><a href="">Sạc dự phòng</a></li>
								<li><a href="">Phụ kiện Khác</a></li>
								<li><a href="">Sạc ô tô các loại</a></li>
							</ul>
						</div>
					</div>
					<div class="boxleft hidden-xs">
						<div class="titboxl">
							<i class="fa fa-share fa-x2 fa-lg" aria-hidden="true"></i>
							<span>Sản phẩm hot</span>
                        </div>
						<div class="ctboxleft">
							<!-- <div class="boxspl">
								<div class="col-xs-4 p0">
									<a href=""><img src="images/img1.jpg" alt=""></a>
								</div>
                            </div> -->
                            @foreach($hots as $hot)
							<div class="boxspl">
								<div class="col-xs-4 p0">
									<a href=""><img src="{{URL::asset('images/'.$hot->product_image)}}" alt=""></a>
								</div>
								<div class="col-xs-8 p5">
									<div class="tit-boxspl">
										<a href="">{{$hot->product_name}}</a>
									</div>
									<div class="price-boxspl">{{number_format($hot->product_price)}}đ</div>
								</div>
                            </div>
                            @endforeach

						</div>
					</div>
					<div class="boxleft hidden-xs">
						<div class="titboxl">
							<i class="fa fa-random fa-x2 fa-lg" aria-hidden="true"></i>
							<span>Sản phẩm bán chạy</span>
						</div>
						<div class="ctboxleft">
                            @foreach($tops as $top)
							<div class="boxspl">
								<div class="col-xs-4 p0">
									<a href=""><img src="{{URL::asset('images/'.$top->product_image)}}" alt=""></a>
								</div>
								<div class="col-xs-8 p5">
									<div class="tit-boxspl">
										<a href="">{{$top->product_name}}</a>
									</div>
									<div class="price-boxspl">{{number_format($top->product_price)}}đ</div>
								</div>
                            </div>
                            @endforeach
						</div>
					</div>
					<div class="boxleft hidden-xs">
						<div class="titboxl">
							<i class="fa fa-rss-square fa-x2 fa-lg" aria-hidden="true"></i>
							<span>Tin tức</span>
						</div>
						<div class="ctboxleft">
							<div id="slider-tintuc" class="owl-carousel">
				                <div class="item tintucl">
				                	<a href=""><img src="{{URL::asset('images/img-tin.jpg')}}"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				                <div class="item tintucl">
				                	<a href=""><img src="{{URL::asset('images/img-tin.jpg')}}"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				                <div class="item tintucl">
				                	<a href=""><img src="{{URL::asset('images/img-tin.jpg')}}"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				                <div class="item tintucl">
				                	<a href=""><img src="{{URL::asset('images/img-tin.jpg')}}"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				            </div>
						</div>
					</div>
					<div class="boxleft hidden-xs">
						<div class="ctboxleft qc">
							<a href=""><img src="{{URL::asset('images/cach-thuc-mua-hang.gif')}}"></a>
						</div>
					</div>
				</div>
				<div id="maincontent" class="col-xs-12 col-sm-8 col-md-9">
					<div class="boxmain">
						<div class="tit-boxmain">
							<h3><span>{{$cate_name[0]['name']}}</span></h3>
						</div>

						<div class="ct-boxmain row m0 ">
                        @foreach($products as $product)
                        <?php $image_product=explode(",", $product->path);?>
							<div class="col-xs-6 col-sm-4 col-md-3 p5">
								<div class="boxsp">
			                		<div class="imgsp">
			                			<a href="{{route('product.detail',['id'=>$product->id])}}">@if($image_product)<img class="imgproduct" src="{{URL::asset('images/'.$image_product[0])}}">@endif</a>
			                			<!-- <div class="img-label">
			                				<img src="images/hot.png">
			                			</div> -->
			                		</div>
			                		<div class="namesp">
			                			<a href="{{route('product.detail',['id'=>$product->id])}}">{{$product->product_name}}</a>
			                		</div>
			                		<div class="pricesp">{{number_format($product->price)}} đ</div>
			                		<div class="button-hd">
				                		<a href="{{url('/add-to-cart',['id'=>$product->id])}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
				                		<a href="{{route('product.detail',['id'=>$product->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
				                	</div>
			                	</div>
							</div>
                        @endforeach
						</div>

					</div>


				</div>
			</section>
		</div>
	</div>
    @endsection
