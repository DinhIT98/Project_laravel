@extends('admin\layout\master')
@section('content')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#content',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: true
  });
</script>
<div class="content-wrapper">
<section class="content-header"></section>
<section class="content">
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class="card">
    <div class="card-header">
        <h3 class="text-center">Edit news</h3>
    </div>
    <div class="card-body">
        <form action="{{route('storeEditNews')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="id" id="id" value="{{$data[0]['id']}}" hidden>
        <div class="form-group">
          <label for="">Title</label>
          <input type="text" class="form-control" value="{{$data[0]['title']}}" name="title" id="title" aria-describedby="helpId" placeholder="Title">
        </div>
        <div class="form-group">
          <label for="">Summary</label>
          <textarea class="form-control" value="{{$data[0]['summary']}}" name="summary" id="summary" aria-describedby="helpId" placeholder="Summary">{{$data[0]['summary']}}</textarea>
        </div>
        <div class="form-group">
            <label class="col control-label" for="content">Content</label>
                <div class="col">
                 <textarea  class="form-control " id="content" name="content" value="{{$data[0]['content']}}">{!!$data[0]['content']!!}</textarea>
            </div>
        </div>
        @if($data[0]['image']!=null)
        <div class="form-group">
            <input type="text" id="path" name="path" value="{{$data[0]['image']}}" hidden>
            <div class="item-gallery" ><img id="imageNews" width="300" height="250" src="{{URL::asset('images/'.$data[0]['image'])}}" alt=""></div>
        </div>
        @endif
        <div class="form-group">
            <label class="col-md-6 control-label" for="filebutton">image</label>
                <div class="col-md-6">
                    <input id="image" name="image" class="input-file" type="file">
                </div>
        </div>
        <button type="submit" class="btn btn-primary col">Submit</button>
        </form>
    </div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function () {
        $(document).on('click','#imageNews',function(){
            var path=$('#path').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "{{route('deleteImageNews')}}",
                data: {path:path,_token:_token},
                success: function (response) {
                    $('#imageNews').remove();
                }
            });
        });

    });
    </script>
@endsection('content')


