@extends('admin/layout/master')
@section('content')
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<div class="content-wrapper">
<section class="content-header"></section>
<section class="content">
<div class="card">
  <div class="card-header">
    <h3 class="text-center">Edit quantity</h3>
  </div>
  <div class="card-body ">
  @if(session()->has('errors'))
    <div class="alert alert-danger">
        <ul>
            {{session('errors')}}
        </ul>
    </div>
    @endif
<form class="form-horizontal" action="{{route('storeEditProduct')}}" method="POST" enctype="multipart/form-data" >
@csrf
<fieldset>
@foreach($product_order as $product)

<input type="text" name="product_id" id="product_id" value="" hidden>
<div class="form-group ">
  <label class="col control-label" for="product_name">Product_name</label>
  <div class="col">
  <input id="product_name" name="product_name" placeholder="Product_name" class="form-control input-md" required="" type="text" value="{{$product->product_name}}">
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col control-label" for="percentage_discount">Price</label>
  <div class="col">
  <input id="price" name="price" placeholder="Price" class="form-control input-md" required="" type="text" value="{{number_format($product->price)}}đ">

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col control-label" for="Status">Status</label>
  <div class="col">
  <input id="Status" name="status" placeholder="status" class="form-control input-md"  type="text" value="{{$product->status}}">

  </div>
</div>

<!-- Text input-->
<div class="form-group ">
  <label class="col control-label " for="author">Quantity</label>
  <div class="col ">
  <input id="Quantity" name="Quantity"  class="form-control input-md"  type="number" value="">

  </div>
</div>
<!-- Text input-->

<div class="form-group ">
  <div class="col ">
  <div class="img-small-wrap d-flex overflow-auto">
    <div id="{{$key}}" class="item-gallery border shadow mr-2 imagesp">
        <img src="{{URL::asset('images/'.$img->path)}} " height=200px min-width=200px>
    </div>
  </div>
  </div>
</div>

 <!-- File Button -->


<!-- Button -->
<div class="form-group">
  <label class="col-md-6 control-label" for="insert_product"></label>
  <div class="col text-center">
    <button id="insert_product" type="submit" name="insert_product" class="btn btn-primary col">Update</button>
  </div>
  </div>
@endforeach
</fieldset>
</form>
</div>
  </div>
  </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $(document).on('click','.delete',function(){
        var id=$(this).attr('id');
        var path=$(this).attr('value');
        // console.log(path)
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "{{route('image.Delete')}}",
            data:{path:path,_token:_token},
            success: function (response) {
                $('#'+id).remove();
                alert(response.success);
            }
        });
    });
});
</script>
@endsection('content')
