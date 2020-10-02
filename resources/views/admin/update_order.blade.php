@extends('admin\layout\master')
@section('content')
<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3>Update status order</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                  <label for="">Đơn hàng</label>
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                <div class="form-group">
                    <label for="">Status</label>
                    <select class="custom-select" name="" id="">
                        <option selected>Mới đặt hàng </option>
                        <option value="">Chuẩn bị giao hàng</option>
                        <option value="">Đang giao hàng</option>
                        <option value="">Giao hàng thành công</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary col">Update</button>
            </div>
        </div>
    </section>
</div>
@endsection('content')
