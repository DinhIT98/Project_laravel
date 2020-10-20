@extends('admin\layout\master')
@section('content')
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
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
<section class="content-header"></section>
<section class="content">
<div class="card">
  <div class="card-header">
    <h3 class="text-center">Edit product</h3>
  </div>
  <div class="card-body ">

<form class="form-horizontal" action="{{route('storeEditProduct')}}" method="POST" enctype="multipart/form-data" >
@csrf
<fieldset>

<!-- Form Name -->
<!-- <legend class="text-center">PRODUCTS</legend> -->

<!-- Text input-->
@foreach($products as $product)
<?php $pt_category=$product->products_categories;
$image =$product->imageupload;?>
<input type="text" name="product_id" id="product_id" value="{{$product->id}}" hidden>
<div class="form-group ">
  <label class="col control-label " for="product_code">Product_code</label>
  <div class="col ">
  <input id="product_code" name="product_code" placeholder="Product_code" class="form-control input-md" required="" type="text" value="{{$product->product_code}}">
  </div>
</div>

<!-- Text input-->
<div class="form-group ">
  <label class="col control-label" for="product_name">Product_name</label>
  <div class="col">
  <input id="product_name" name="product_name" placeholder="Product_name" class="form-control input-md" required="" type="text" value="{{$product->product_name}}">

  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col control-label" for="product_categorie">Product category</label>
  <div class="col">
    <select id="product_categorie" name="product_categorie" class="form-control">
    @foreach($category as $cate)
    <option value="{{$cate->id}}" <?php echo ($cate->id===$pt_category[0]->category_id) ?  "selected" : "" ;  ?>>{{$cate->name}}</option>
    @endforeach

    </select>

  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col control-label" for="product_description">Product description</label>
  <div class="col ">
    <textarea style ="height:350px" class="form-control" id="product_description" name="product_description" value="{{$product->description}}">{{$product->description}}</textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col control-label" for="percentage_discount">Price</label>
  <div class="col">
  <input id="price" name="price" placeholder="Price" class="form-control input-md" required="" type="text" value="{{number_format($product->price)}}">

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
  <label class="col control-label " for="author">Warranty</label>
  <div class="col ">
  <input id="warranty" name="warranty" placeholder="Warranty" class="form-control input-md"  type="text" value="{{$product->warranty}}">

  </div>
</div>
<!-- Text input-->


<div class="form-group ">

  <div class="col ">
  <div class="img-small-wrap d-flex overflow-auto">
                @if(isset($image))
                    @foreach($image as $key=>$img)
                    <div id="{{$key}}" class="item-gallery border shadow mr-2 imagesp"> <img src="{{URL::asset('images/'.$img->path)}} " height=200px>
                    <div class="btn_delete ">
                         <a class="delete" id="{{$key}}" value="{{$img->path}}" style="border:none; padding:0;"> <span class="fa fa-window-close fa-16px text-red mt-0"></span></a>
                    </div>
                     </div>
                    @endforeach
                @endif
  </div>

  </div>
</div>

 <!-- File Button -->
<div class="form-group">
  <label class="col-md-6 control-label" for="filebutton">image</label>
  <div class="col-md-6">
    <input id="image" name="image[]" class="input-file" type="file" multiple value="{{$image[0]}}">
  </div>
</div>

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
