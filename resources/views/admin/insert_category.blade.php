@extends('admin\layout\master')
@section('content')
<div class="content-wrapper">
<section class="content">
<div class="cart">
    <div class="cart-header">
        <h3>Insert category</h3>
    </div>
    <div class="cart-body">
        <form action="">
        <div class="form-group col-md-6">
          <label for="">Category name</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Category name">
        </div>
        <div class="form-group col-md-6">
            <label for="my-select">level</label>
            <select id="my-select" class="form-control" name="">
                <option>1</option>
                <option>2</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="my-select">Parent</label>
            <select id="my-select" class="form-control" name="">
                <option>Laptop</option>
                <option>Watch</option>
                <option>Laptop</option>
                <option>Watch</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary col-md-6">Submit</button>
        </form>
    </div>
</div>
</section>
</div>
@endsection('content')
