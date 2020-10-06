@extends('Layout/master')
@section('content')
        <div class="container checkout">
            <a href="/home">Mua thêm sản phẩm khác</a>
            <form class="needs-validation" method="POST" action="{{route('checkout.store')}}" >
				<div class="row">
				  <div class="col-md-4 order-md-2 mb-4">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
					  <span class="text-muted">Giỏ hàng</span>
					  <span class="badge badge-secondary badge-pill">1</span>
					</h4>
					<ul class="list-group mb-3">
                    <?php $total=0;?>

                    @foreach($product as $pro)
                    <?php $total+=$pro->price;
                    $image=$pro->imageupload?>
					  <li class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
						  <h6 class="my-0">{{$pro->product_name}}</h6>
                          <input type="text" value="{{$pro->product_name}}" name="product_name" hidden>
                          <input type="text" value="{{$pro->product_code}}" name="product_code" hidden>
                          <input type="text" value="{{$pro->price}}" name="product_price" hidden>
                          <input type="text" value="{{$image[0]->path}}"  name="product_image" hidden>
						  <small class="text-muted text-danger">{{$pro->status}}</small>
						</div>
						<span class="text-muted">{{number_format($pro->price)}} đ</span>

                      </li>
                    @endforeach

					  <li class="list-group-item d-flex justify-content-between">
                        <span>Số lượng:<input type="number" min="1" value="1" style="border:none;" class="text-center" name="quantity" id="quantity"></span>
                        <br>
                        <span>Total (VND)</span>
                        <strong>{{$total}}</strong>

					  </li>
					</ul>
				  </div>

				  <div class="col-md-8 order-md-1">
					<h4 class="mb-3">Thông tin </h4>
					<!-- <form class="needs-validation" method="POST" action="{{route('checkout.store')}}" > -->
                    @csrf
                    <input type="text" name="product_id" value="{{$pro->id}}" hidden>
                    <input type="text" name="total" value="{{$total}}" hidden>
					  <div class="row">
						<div class="col-md-6 mb-3">
						  <label for="firstName">Họ & tên</label>
						  <input type="text" class="form-control" id="name" name="name" placeholder="Nguyễn Văn A" value="" required>
						</div>
						<div class="col-md-6 mb-3">
						  <label for="phone">Số điện thoại</label>
						  <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="" required>
						</div>
					  </div>
					  <br>

						<!-- <div class=" mb-3">
							<label for="username">Username</label>
							<div class="input-group">
							  <input type="text" class="form-control" id="username" placeholder="" required>
							</div>
						</div> -->

					  <br>
					  <div class="mb-3">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
					  </div>
					  <br>
					  <div class="mb-3">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="" required>
					  </div>

					  <hr class="mb-4">
					  <div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="save-info">
						<label class="custom-control-label" for="save-info">Lưu thông tin liên hệ </label>
					  </div>
					  <hr class="mb-4">

					  <h4 class="mb-3">Hình thức thanh toán</h4>

					  <div class="d-block my-3">
						<div class="custom-control custom-radio">
						  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
						  <label class="custom-control-label" for="credit">Thanh toán khi nhận hàng(COD)</label>
						</div>
						<div class="custom-control custom-radio">
						  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
						  <label class="custom-control-label" for="debit">ATM</label>
						</div>
						<div class="custom-control custom-radio">
						  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
						  <label class="custom-control-label" for="paypal">MOMO</label>
						</div>
					  </div>

					  <hr class="mb-4">
					  <button class="btn btn-primary btn-lg btn-block" type="submit">ĐẶT HÀNG</button>
					<!-- </form> -->
				  </div>
                </div>
            </form>
			  </div>
@endsection('content')
