@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <a href="/admin/order" class="btn btn-primary mb-2">Back</a>
          <div id="alert" class="alert alert-success alert-dismissible" style="display:none;">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong id="message"></strong>
                 </div>
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Detail order</h3> -->

                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($user_data as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->user_email}}</td>
                    <td>{{$user->user_phone}}</td>
                    <td>{{$user->user_address}}</td>
                    <td>{{$user->total_price}}</td>
                    <td>{{$user->status}}</td>
                  </tr>
                @endforeach

                  </tfoot>
                </table>
                <!-- <a href="{{route('fileExportOrders')}}" class="btn btn-primary float-right mr-2">export</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created_at</th>
                    <th>edit</th>
                    <th>delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $detail)
                  <tr id="row{{$detail->product_code}}">
                    <td>{{$detail->product_id}}</td>
                    <td>{{$detail->product_name}}</td>
                    <td><img src="{{asset('images/'.$detail->product_image)}}" alt="" height=100px ></td>
                    <td>{{$detail->product_price}}</td>
                    @csrf
                    <td><input class="form-control text-center" type="number" min=1 name="quantity" value="{{$detail->product_qty}}" id="quantity{{$detail->product_code}}"></td>
                    <td>{{$detail->created_at}}</td>
                    <td> <button class="edit btn btn-success" id="{{$detail->product_code}}" value="{{$user->id}}"><i class="fa fa-edit"></i></button> </td>
                    <td> <button class="delete btn btn-danger" id="{{$detail->product_code}}" value="{{$user->id}}"><i class="fa fa-trash"></button></td>
                  </tr>
                  @endforeach

                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function () {
        // $(document).on('keyup input','.quantity',function(){
        //     var id =$(this).attr('id');
        //     var quantity =$(this).val();
        //     console.log(quantity);

        // });
        $(".edit").click(function(){
                var id =$(this).attr('id');
                var quantity=$("#quantity"+id).val();
                var _token = $('input[name="_token"]').val();
                var order_id=$(this).attr('value');
                console.log(order_id);
                $.ajax({
                    type: "POST",
                    url: "{{route('storeEditDetailOrder')}}",
                    data:{ id:id,quantity:quantity,order_id:order_id,_token:_token },
                    success: function (response) {
                        $('#alert').fadeIn(function(){
                            $("#message").text(response.message);
                        $("html, body").animate({scrollTop:0},500);

                    });
                    $("#alert").fadeOut(5000);

                        // alert(response.data);
                    }
                });
            });
        $(".delete").click(function(){
            var id=$(this).attr('id');
            var _token =$('input[name="_token"]').val();
            var order_id=$(this).attr('value');
            console.log('delete'+order_id);
            $.ajax({
                type: "POST",
                url: "{{route('deleteDetailOrder')}}",
                data: {id:id,order_id,_token:_token},
                success: function (response) {
                    $('#row'+id).remove();
                    console.log(response.success);
                    $('#alert').fadeIn(function(){
                            $("#message").text(response.message);
                        $("html, body").animate({scrollTop:0},500);

                    });
                    $("#alert").fadeOut(5000);

                }
            });

        });
      });
  </script>
  @endsection('content')
