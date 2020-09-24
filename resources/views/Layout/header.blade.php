<header id="header">
		<div class="topbar">
			<div class="container">
				<div class="col-xs-12 col-sm-6 p0 hotline-top">
					<img src="{{URL::asset('images/phone-24.png')}}" alt="hotline" />
					<p>Điện thoại: <a href="tel:01649.629.629">01649.629.629</a></p>
				</div>
			</div>
		</div>
		<div class="header">
			<div class="container">
				<div class="col-xs-12 col-md-4">
					<div id="logo">
						<a href=""><img src="{{URL::asset('images/logo.png')}}" alt=""></a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div id="search">
						<form action="" method="post">
							<input type="text" name="txt_search" placeholder="Tìm phụ kiện" />
							<button type="submit" name="btn_search">Tìm kiếm</i></button>
						</form>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="cart">
						<div class="discart">
							<a href="/cart"><span class="mycart">Giỏ hàng:</span></a>
							<span class="count_products_cart">{{count(session('cart'))}} sản phẩm</span>
						</div>
						<!-- <div class="top-cart-content">

						</div> -->
					</div>
				</div>
			</div>
		</div>
		<nav id="mainmenu" class="hidden-xs hidden-sm ">
			<div class="container">
				<ul class="x1">
					<li><a href="{{route('home')}}">Trang chủ</a></li>
					<li>
						<a href="">Sản phẩm</a>
						<i class="fa fa-caret-down" aria-hidden="true"></i>
						<ul class="drop2">
                        @foreach($category_1 as $cate_1)
								<li>
									<a href="{{route('show.category',['cate'=>$cate_1->id])}}">{{$cate_1->name}}</a>
                                </li>
                                <ul class="drop4">
                                    @foreach($category_2 as $cate_2)
                                        @if($cate_1->id == $cate_2->parent_id)
										<li><a href="">{{$cate_2->name}}</a></li>
                                        @endif
                                    @endforeach
                                    </ul>
                        @endforeach

						</ul>
					</li>
					<li><a href="">Giới thiệu</a></li>
					<li><a href="">Tin tức</a></li>
					<li><a href="">Tư vấn</a></li>
					<li><a href="">Liên hệ</a></li>
					<li><a href="tel:01649.629.629">HOTLINE: 01649.629.629 (từ 8h-22h cả T7,CN)</a></li>
				</ul>
			</div>
		</nav>
	</header>
