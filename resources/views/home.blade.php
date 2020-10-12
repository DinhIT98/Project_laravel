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
			                <a href=""><img src="images/slide3.png" alt="" /></a>
			                <a href=""><img src="images/slide4.png" alt="" /></a>
                            <a href=""><img src="images/slide5.png" alt="" /></a>
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
                            <?php $path ='images/'.$hot->product_image;?>
							<div class="boxspl">
								<div class="col-xs-4 p0">
									<a href="{{route('product.detail',['id'=>$hot->product_id])}}">@if(is_file(public_path($path)))<img src="images/{{$hot->product_image}}" alt="">@else<img src="images/image-not-found.png" alt="">@endif</a>
								</div>
								<div class="col-xs-8 p5">
									<div class="tit-boxspl">
										<a href="{{route('product.detail',['id'=>$hot->product_id])}}">{{$hot->product_name}}</a>
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
                            <?php $path='images/'.$top->product_image; ?>
							<div class="boxspl">
								<div class="col-xs-4 p0">
                                <a href="{{route('product.detail',['id'=>$top->product_id])}}">@if(is_file(public_path($path)))<img src="images/{{$top->product_image}}" alt="">@else<img src="images/image-not-found.png" alt="">@endif</a>
								</div>
								<div class="col-xs-8 p5">
									<div class="tit-boxspl">
										<a href="{{route('product.detail',['id'=>$top->product_id])}}">{{$top->product_name}}</a>
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
				                	<a href=""><img src="images/img-tin.jpg"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				                <div class="item tintucl">
				                	<a href=""><img src="images/img-tin.jpg"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				                <div class="item tintucl">
				                	<a href=""><img src="images/img-tin.jpg"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				                <div class="item tintucl">
				                	<a href=""><img src="images/img-tin.jpg"></a>
				                	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
				                	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
				                </div>
				            </div>
						</div>
					</div>
					<div class="boxleft hidden-xs">
						<div class="ctboxleft qc">
							<a href=""><img src="images/cach-thuc-mua-hang.gif"></a>
						</div>
					</div>
				</div>

				<div id="maincontent" class="col-xs-12 col-sm-8 col-md-9">
                <!-- @if(session()->get( 'message' ))
                <div class="alert alert-success alert-dismissible" >
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{session()->get( 'message' )}}</strong>
                 </div>
                @endif -->

                <div id="alert" class="alert alert-success alert-dismissible" style="display:none;">
                    <!-- <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                    <strong id="message"></strong>
                 </div>

					<div class="boxmain spmoi">
						<div class="tit-boxmain">
							<h3><span>Sản phẩm mới</span></h3>
						</div>
						<div class="ct-boxmain">
							<div class="row">
								<div id="spmoi" class="owl-carousel">
                                @foreach($products as $product)
                                   <?php $image=$product->imageupload;
                                   $path='images/'.$image[0]->path;

                                  ?>

									<div class="item">
					                	<div class="boxsp">
					                		<div class="imgsp">
					                			<a href="{{route('product.detail',['id'=>$product->id])}}">@if(is_file(public_path($path)))<img class="imgproduct" src="images/{{$image[0]->path}}">@else<img class="imgproduct" src="images/image-not-found.png">@endif</a>
					                			<div class="img-label">
					                				<img src="images/new.png">
					                			</div>
					                		</div>
					                		<div class="namesp">
					                			<a href="{{route('product.detail',['id'=>$product->id])}}">{{$product->product_name}}</a>
					                		</div>
					                		<div class="pricesp">{{number_format($product->price)}} đ</div>
                                            <div class="status_sp">{{$product->status}}</div>
					                		<div class="button-hd">
						                		<a  class="addToCart" id="{{$product->id}}" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
						                		<a href="{{route('product.detail',['id'=>$product->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
						                	</div>
					                	</div>
					                </div>
                                @endforeach

				              	</div>
							</div>
						</div>
					</div>

					<div class="boxmain">
						<div class="tit-boxmain">
							<h3><span>Điện thoại</span></h3>
						</div>
						<div class="ct-boxmain row m0">
                        <?php $i=0; ?>
                        @foreach($smartphone as $phone)
                        <?php $category=$phone->products_categories;?>
                        @foreach($category as $cate)
                        <?php $cate_id=$cate->category_id;?>
                        @endforeach
                        @if($cate_id=='10' && $i<4)
                        <?php $image_smart=$phone->imageupload;
                        $path='images/'.$image_smart[0]->path;
                        $i++;?>
							<div class="col-xs-6 col-sm-4 col-md-3 p5">
								<div class="boxsp">
			                		<div class="imgsp">
			                			<a href="{{route('product.detail',['id'=>$phone->id])}}">@if(is_file(public_path($path)))<img class="imgproduct" src="images/{{$image_smart[0]->path}}">@else <img class="imgproduct" src="images/image-not-found.png" alt="">@endif</a>
			                			<div class="img-label">
			                				<img src="images/hot.png">
			                			</div>
			                		</div>
			                		<div class="namesp">
			                			<a href="{{route('product.detail',['id'=>$phone->id])}}">{{$phone->product_name}}</a>
			                		</div>
                                    <div class="pricesp">{{number_format($phone->price)}} đ</div>
                                    <div class="status_sp">{{$phone->status}}</div>
			                		<div class="button-hd">
				                		<a class="addToCart" id="{{$phone->id}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
				                		<a href="{{route('product.detail',['id'=>$phone->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
				                	</div>
			                	</div>
							</div>
                        @endif
                        @endforeach
						</div>

					</div>
					<div class="boxmain">
						<div class="tit-boxmain">
							<h3><span>Laptop</span></h3>
						</div>
						<div class="ct-boxmain row m0">
                        <?php $i=0; ?>
                        @foreach($laptop as $lap)
                        <?php $category=$lap->products_categories;?>
                        @foreach($category as $cate)
                        <?php $cate_id=$cate->category_id;?>
                        @endforeach
                        @if($cate_id=='9' && $i<4)
                        <?php $image_lap=$lap->imageupload;
                        $path='images/'.$image_lap[0]->path;
                        $i++;?>
							<div class="col-xs-6 col-sm-4 col-md-3 p5">
								<div class="boxsp">
			                		<div class="imgsp">
			                			<a href="{{route('product.detail',['id'=>$lap->id])}}">@if(is_file(public_path($path)))<img class="imgproduct" src="images/{{$image_lap[0]->path}}">@else <img class="imgproduct" src="images/image-not-found.png" alt="">@endif </a>
			                			<div class="img-label">
			                				<img src="images/hot.png">
			                			</div>
			                		</div>
			                		<div class="namesp">
			                			<a href="{{route('product.detail',['id'=>$lap->id])}}">{{$lap->product_name}}</a>
			                		</div>
                                    <div class="pricesp">{{number_format($lap->price)}} đ</div>
                                    <div class="status_sp">{{$lap->status}}</div>
			                		<div class="button-hd">
				                		<a class="addToCart" id="{{$lap->id}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
				                		<a href="{{route('product.detail',['id'=>$lap->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
				                	</div>
			                	</div>
                            </div>
                            @endif
                        @endforeach
						</div>
					</div>
					<div class="boxmain">
						<div class="tit-boxmain">
							<h3><span>Đồng hồ</span></h3>
						</div>
						<div class="ct-boxmain row m0">
                        <?php $i=0; ?>
                        @foreach($watchs as $watch)
                        <?php $category=$watch->products_categories;?>
                        @foreach($category as $cate)
                        <?php $cate_id=$cate->category_id;?>
                        @endforeach
                        @if($cate_id=='8' && $i<4)
                        <?php $image_watch=$watch->imageupload;
                        $path='images/'.$image_watch[0]->path;
                        $i++;?>
                        <input type="text " id="" value="{{$watch->id}}" hidden>
							<div class="col-xs-6 col-sm-4 col-md-3 p5">
								<div class="boxsp">
			                		<div class="imgsp">
			                			<a href="{{route('product.detail',['id'=>$watch->id])}}">@if(is_file(public_path($path)))<img class="imgproduct" src="images/{{$image_watch[0]->path}}">@else <img class="imgproduct" src="images/image-not-found.png" alt=""> @endif</a>
			                			<div class="img-label">
			                				<img src="images/hot.png">
			                			</div>
			                		</div>
			                		<div class="namesp">
			                			<a href="{{route('product.detail',['id'=>$watch->id])}}">{{$watch->product_name}}</a>
			                		</div>
                                    <div class="pricesp">{{number_format($watch->price)}} đ</div>
                                    <div class="status_sp">{{$watch->status}}</div>
			                		<div class="button-hd">
				                		<a class="addToCart" id="{{$watch->id}}" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
				                		<a href="{{route('product.detail',['id'=>$watch->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
				                	</div>
			                	</div>
                            </div>
                            @endif
                        @endforeach
						</div>
					</div>
				</div>
			</section>
		</div>
        <p id="demo"></p>
	</div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
@if(session()->get( 'success' ))
    <script>
        alert('Thank you for your order!');
    </script>
@endif

<script>
$(document).ready(function () {
    $(".addToCart").click(function(){
        var id=$(this).attr('id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "{{route('addToCartAjax')}}",
            data: {id:id, _token:_token},

            success: function (response) {
                $('#alert').fadeIn(function(){
                    $("#message").text(response.message);
                    $("html, body").animate({scrollTop:0});

                });
                $("#alert").fadeOut(3000);

            }
        });
        $.ajax({
            type: "GET",
            url: "{{route('getCart')}}",
            success: function (response) {
               console.log(response.data);
               $('#cart').html(response.data+" sản phẩm");
            }
        });

    });
    $(document).on('click', function(){
    $('#alert').fadeOut();
  });

});
</script>
@endsection
