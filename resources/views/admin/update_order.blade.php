@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3>Update status order</h3>
            </div>
            <div class="card-body">
            <form action="{{route('storeStatusOrder')}}" method="post">
            @csrf
                <div class="form-group">
                  <label for="">Đơn hàng</label>
                  <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="" value="{{$order[0]['id']}}" readonly>
                <div class="form-group">
                    <label for="">Status</label>
                    <select class="custom-select" name="status" id="status">
                        <option value="Mới đặt hàng" <?php echo ($order[0]['status']=="Mới đặt hàng") ?  "selected" : "" ;  ?>>Mới đặt hàng </option>
                        <option value="Tiếp nhận đơn hàng" <?php echo ($order[0]['status']=="Tiếp nhận đơn hàng") ?  "selected" : "" ;  ?>>Tiếp nhận đơn hàng</option>
                        <option value="Đang giao hàng" <?php echo ($order[0]['status']=="Đang giao hàng") ?  "selected" : "" ;  ?>>Đang giao hàng</option>
                        <option value="Giao hàng thành công" <?php echo ($order[0]['status']=="Giao hàng thành công") ?  "selected" : "" ;  ?>>Giao hàng thành công</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary col">Update</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection('content')
