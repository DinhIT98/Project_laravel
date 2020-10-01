@extends('admin\layout\master')
@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#product_description',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: true
  });
</script>
<!------ Include the above in your HEAD tag ---------->
<div class="content-wrapper">
<div class="cart">
  <div class="cart-header">
    <h3 class="text-center">Insert product</h3>
  </div>
  <div class="cart-body">

<form class="form-horizontal" action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data" >
@csrf
<fieldset>

<!-- Form Name -->
<!-- <legend class="text-center">PRODUCTS</legend> -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_code">Product_code</label>
  <div class="col-md-4">
  <input id="product_code" name="product_code" placeholder="Product_code" class="form-control input-md" required="" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">Product_name</label>
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="Product_name" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_categorie">Product category</label>
  <div class="col-md-4">
    <select id="product_categorie" name="product_categorie" class="form-control">
    @foreach($category as $cate)
    <option value="{{$cate->id}}">{{$cate->name}}</option>

    @endforeach
    </select>
  </div>
</div>

<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="available_quantity">Available quantity</label>
  <div class="col-md-4">
  <input id="available_quantity" name="available_quantity" placeholder="Available quantity" class="form-control input-md" required="" type="text">

  </div>
</div> -->
<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_description">Product description</label>
  <div class="col-md-4">
    <textarea class="form-control " id="product_description" name="product_description"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="percentage_discount">Price</label>
  <div class="col-md-4">
  <input id="price" name="price" placeholder="Price" class="form-control input-md" required="" type="text">

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Status">Status</label>
  <div class="col-md-4">
  <input id="Status" name="status" placeholder="status" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="author">Warranty</label>
  <div class="col-md-4">
  <input id="warranty" name="warranty" placeholder="Warranty" class="form-control input-md" required="" type="text">

  </div>
</div>
<!-- Text input-->



 <!-- File Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">image</label>
  <div class="col-md-4">
    <input id="image" name="image" class="input-file" type="file" >
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="insert_product"></label>
  <div class="col-md-4">
    <button id="insert_product" name="insert_product" class="btn btn-primary">Insert</button>
  </div>
  </div>

</fieldset>
</form>
</div>
  </div>
</div>
@endsection('content')
