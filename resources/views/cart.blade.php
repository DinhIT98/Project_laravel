@extends('Layout/master')
@section('content')
<div class="container main-section ">
		<div class="row">
			<div class="col-lg-12 pb-2">
				<h4>Giỏ Hàng</h4>
                @if(session()->get( 'message' ))
                <div class="alert alert-success alert-dismissible">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{session()->get( 'message' )}}</strong>
                 </div>
                @endif
			</div>
			<div class="col-lg-12 pl-3 pt-3">
            <form action="{{route('deleteAndCheckoutCart')}}" method="POST">
            @csrf

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

                    <?php $total=0; $x=0; $y=0; $z=0;$t=0;$check_session=session('cart');?>
                    @if(isset($check_session))
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
                            <input type="text" id="idCart{{$t++}}" hidden value="{{$id}}">
					        <td> {{number_format($val['price'])}}đ</td>
					        <td data-th="Quantity">
								<input type="number" name="quantity[]" id="{{$y++}}" class="form-control text-center" value="{{$val['quantity']}}" min="1">
							</td>
							<td id="total_price{{$z++}}" class="price">{{($val['price'])}}</td>
					        <td class="actions" data-th="" style="width:10%;">
                            <form action="{{route('deleteAndCheckoutCart')}}" method="POST">

                            @csrf
                            <input type="text" name="id" value="{{$id}}" hidden>
								<button class="btn btn-danger btn-sm" name="button" value="delete" onclick="$(this).closest('form').submit()"><i class="fa fa-trash-o"></i></button>
                            </form>
							</td>
				      	</tr>
				    @endforeach
                    @endif
				    </tbody>
				    <tfoot>
						<tr>
							<td><a href="/" class="btn btn-warning text-white"><i class="fa fa-angle-left"></i>Tiếp tục mua sắm</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center" style="width:10%;" id="total"><strong>Tổng:{{number_format($total)}}đ</strong></td>
							<td><button name="button" value="checkout"  class="btn btn-success btn-block">Đặt hàng <i class="fa fa-angle-right"></i></button></td>
                            <td id="demo"></td>
						</tr>
					</tfoot>
				</table>
                </form>
			</div>
		</div>
	</div>
    <script type="text/javascript">
     	$(document).ready(function () {
   $("input[type=number]").bind('keyup input', function(){
        // alert($("#price").text());
        var id=$(this).attr('id');
        var id_price='price'+id;
        var id_total_price='total_price'+id;
        var quantity=$(this).val();
        var price=$("#"+id_price).val();
        var total_price=price*quantity;
        // total_price=new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total_price);
        document.getElementById(id_total_price).innerHTML=total_price;
        var arr_price=$(".price").text();
        var total=0;
        Array.from($(".price")).forEach(function(item){
                 total+=parseInt(item.textContent);
                //  total=new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total);
        });


        document.getElementById("total").innerHTML=total;

    });
         });

    </script>

@endsection('content')
