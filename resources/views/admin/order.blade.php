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


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List order</h3>
                <a href="{{route('fileExportOrders')}}" class="btn btn-primary float-right mr-2">export</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>status</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($orders as $order)
                  <tr id="row{{$order->id}}">
                    <td>{{$order->id}}</td>
                    <td>{{$order->user_name}}</td>
                    <td>{{$order->user_email}}</td>
                    <td>{{$order->user_phone}}</td>
                    <td>{{$order->user_address}}</td>
                    <td>{{($order->total_price)}}</td>
                    <td>{{$order->status}}</td>
                    <td> <a href="{{route('updateStatusOrder',['id'=>$order->id])}}" class="btn btn-success"><i class="fa fa-edit"></i></a> </td>
                    <td>
                    @csrf
                    <button id="{{$order->id}}" class="delete btn btn-danger" type="submit" > <i class="fa fa-trash"></i></button>
                    </td>
                    <td> <a href="{{route('orderDetail',['id'=>$order->id])}}" class="btn btn-success"><i class="fa fa-info"></i></a> </td>
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
        $(document).on('click','.delete',function(){
            var id =$(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "{{route('deleteOrder')}}",
                data:{id:id,_token:_token},
                success: function (response) {
                    $('#row'+id).remove();
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
  @endsection('content)
