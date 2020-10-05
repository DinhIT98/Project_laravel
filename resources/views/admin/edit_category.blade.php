@extends('admin\layout\master')
@section('content')
<div class="content-wrapper">
<section class="content-header"></section>
<section class="content">
<div class="card">
    <div class="card-header">
        <h3 class="text-center">Edit category</h3>
    </div>
    <div class="card-body">
        <form action="{{route('storeEditCate')}}" method="POST">
        @csrf
        <input type="text" value="{{$category[0]['id']}}" name="id" id="id" hidden>
        <div class="form-group">
          <label for="">Category name</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" value="{{$category[0]['name']}}">
        </div>
        <div class="form-group">
            <label for="my-select">level</label>
            <select id="my-select" class="form-control" name="level" id="level">
                <option value="1"<?php echo ($category[0]['level']==1) ? "selected":"disabled"?>>1</option>
                <option value="2" <?php echo ($category[0]['level']==2) ? "selected":"disabled"?>>2</option>
            </select>
        </div>
        @if($category[0]['level']==2)
        <div class="form-group ">
            <label for="my-select">Parent</label>
            <select id="my-select" class="form-control" name="parent_id">
            @foreach($category_1 as $cate)
                <option value="{{$cate->id}}" <?php echo($category[0]['parent_id']==$cate->id) ? "selected":""?>>{{$cate->name}}</option>

            @endforeach
            </select>
        </div>
        @endif
        <button type="submit" class="btn btn-primary col">Update</button>
        </form>
    </div>
</div>
</section>
</div>
@endsection('content')
