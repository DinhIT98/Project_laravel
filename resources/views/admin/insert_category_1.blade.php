@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
<section class="content-header"></section>
<section class="content">
<div class="card">
    <div class="card-header">
        <h3 class="text-center">Insert category</h3>
    </div>
    <div class="card-body">
        <form action="{{route('storeInsertCate_1')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="">Category name</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Category name">
        </div>
        <div class="form-group">
            <label for="my-select">level</label>
            <select id="my-select" class="form-control" name="level" id="level">
                <option value="1" selected>1</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary col">Submit</button>
        </form>
    </div>
</div>
</section>
</div>
@endsection('content')
