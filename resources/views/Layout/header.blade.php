<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
						<a href="/"><img src="{{URL::asset('images/logo.png')}}" alt=""></a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div id="search">
						<!-- <form action="{{route('search')}}" method="post"> -->

							<input type="text" name="txt_search" id="txt_search" placeholder="Tìm phụ kiện" autocomplete=off/>
							<button type="submit" name="btn_search">Tìm kiếm</i></button>
                            <div id="countryList"><br>
                            </div>
                            {{ csrf_field() }}
						<!-- </form> -->
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 ml-5">
					<div class="cart">
						<div class="discart">
							<a href="/cart"><span class="mycart">Giỏ hàng:</span></a>
							<span id="cart" class="count_products_cart">@if(session('cart')){{count(session('cart'))}}@endif sản phẩm</span>
						</div>
                    </div>
                    @if(Auth::check() && Auth::user()->admin!=1)
                    <div class="cart" style="padding-right:10px" >
                        <div class="discart ">
                            <!-- <span class="material-icons" style="font-size:36px;">account_circle</span> -->

                            <i class="fa fa-user "></i>
                            <a id="user">{{Auth::user()->name}}</a>
                            <span>/ <a href="{{route('logout')}}">logout</a> </span>
                            <div class="order">
                            <ul>
                                <li><a href="{{route('tracking',['user_id'=>Auth::user()->id])}}" >Quản lý đơn hàng</a></li>
                            </ul>
                        </div>
                        </div>

                    </div>


                    @else

                    <div class="cart" style="padding-right:10px" >
                        <div class="discart ">
                        <!-- <span class="material-icons" style="font-size:36px;">account_circle</span> -->
                        <i class="fa fa-user"></i>
                            <a href="/login">Login</a>
                            <span>/ <a href="/register">Register</a> </span>
                        </div>
                    </div>
                    @endif

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
    <script>
  $(document).ready(function(){

   $('#txt_search').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
        var query = $(this).val(); //lấy gía trị ng dùng gõ
        console.log(query);
        if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
        {
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
            $.ajax({
            url:"{{ route('search') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
            method:"POST", // phương thức gửi dữ liệu.
            data:{query:query, _token:_token},
            success:function(data){ //dữ liệu nhận về
            $('#countryList').fadeIn();
            $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
        }
        });
   }
    });

   $(document).on('click', function(){
    // $('#txt_search').val($(this).text());
    $('#countryList').fadeOut();
  });

   $("#user").mouseover(function(){
        $(".order").fadeIn();
        // $(".order").fadeOut(500);
   });
   $("#user").mouseleave(function(){
        // $(".order").fadeIn();
        $(".order").fadeOut(3000);
   });

 });
</script>



