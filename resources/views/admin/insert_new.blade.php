@extends('admin/layout/master')
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
<div class="card">
    <div class="card-header">
        <h3 class="text-center">Insert new</h3>
    </div>
    <div class="card-body">
        <form action="{{route('storeInsertNew')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Title</label>
          <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Title">
        </div>
        <div class="form-group">
          <label for="">Summary</label>
          <textarea class="form-control" name="summary" id="summary" aria-describedby="helpId" placeholder="Summary"></textarea>
        </div>
        <div class="form-group">
            <label class="col control-label" for="content">Content</label>
                <div class="col">
                 <textarea class="form-control " id="content" name="content"></textarea>
            </div>
        </div>
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
@endsection('content')
