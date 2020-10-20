@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div>/.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List products</h3>
                <a href="/admin/insert-product" class="btn btn-primary float-right mb-1">insert</a>
                <a href="{{route('fileExportProducts')}}" class="btn btn-primary float-right mr-2">export</a>
                <a href="{{route('import')}}" class="btn btn-primary float-right mr-2">import</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Warranty</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                  <tr id ="row{{$product->id}}">
                    <td>{{$product->id}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->status}}</td>
                    <td>{{$product->warranty}}</td>
                    <td>
                    @csrf
                    <button id="{{$product->id}}" class="delete btn btn-danger" type="submit"> <i class="fa fa-trash"></i></button>
                    </td>
                    <td><a href="{{route('editProduct',['id'=>$product->id])}}" type='button' class='btn btn-success'><i class="fa fa-edit"></i></a></td>
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
  @if(session()->has('success'))
    <script>
        alert('insert product success!');
    </script>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.delete',function(){
                var id=$(this).attr('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('deleteProduct')}}",
                    data: {id:id,_token:_token},
                    success: function (response) {
                        $('#row'+id).remove();
                        alert(response.success);
                    }
                });
            });
        });
    </script>
  @endsection('content')
