@extends('Layout/master')
@section('content')
<div class="container main-section ">
		<div class="row">
			<div class="col-lg-12 pb-2">
				<h4>Giỏ Hàng</h4>
			</div>
			<div class="col-lg-12 pl-3 pt-3">
				<table class="table table-hover border bg-white">
				    <thead>
				      	<tr>
					        <th>Sản Phẩm</th>
					        <th>Giá</th>
					        <th style="width:10%;">Số lượng</th>
					        <th>Tổng tiền</th>
					        <th>Xóa</th>
				      	</tr>
				    </thead>
				    <tbody>
                    <?php $total=0; $x=0; $y=0; $z=0;?>
                        @foreach(session('cart') as $id=>$val)
                        <?php $total+=($val['price']*$val['quantity']);
                              $path=explode(",", $val['image']);
                        ?>

				      	<tr>
					        <td>
					        	<div class="row">
									<div class="col-lg-2 Product-img">
										<img src="{{URL::asset('images/'.$path[0])}}" alt="..." class="img-responsive"/>
									</div>
									<div class="col-lg-10">
										<h4 class="nomargin">{{$val['name']}}</h4>
										<p>{{$val['status']}}</p>
                                        <p>{{$val['warranty']}}</p>
									</div>
								</div>
					        </td>
                            <input type="text" id="price{{$x++}}" hidden value="{{$val['price']}}">
					        <td> {{number_format($val['price'])}}đ</td>
					        <td data-th="Quantity">
								<input type="number" id="{{$y++}}" class="form-control text-center" value="{{$val['quantity']}}" min="1">
							</td>
							<td id="total_price{{$z++}}" class="price">{{($val['price'])}}</td>
					        <td class="actions" data-th="" style="width:10%;">
                            <form action="{{route('removeCart',['id'=>$id])}}" method="POST">
                            @method('delete')
                            @csrf
								<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                            </form>
							</td>
				      	</tr>
				    @endforeach
				    </tbody>
				    <tfoot>
						<tr>
							<td><a href="/home" class="btn btn-warning text-white"><i class="fa fa-angle-left"></i>Tiếp tục mua sắm</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center" style="width:10%;" id="total"><strong>Tổng:{{number_format($total)}}đ</strong></td>
							<td><a href="/checkout-cart" class="btn btn-success btn-block">Đặt hàng <i class="fa fa-angle-right"></i></a></td>
                            <td id="demo"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

@endsection('content')
