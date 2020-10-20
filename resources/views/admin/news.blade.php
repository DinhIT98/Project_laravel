@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
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
                <h3 class="card-title"></h3>
                <a href="/admin/insert-new" class="btn btn-primary float-right mb-1">insert</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <!-- <th>Content</th> -->
                    <th>Author</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($news as $new )
                  <tr id="row{{$new->id}}">
                    <td>{{$new->id}}</td>
                    <td>{{$new->title}}</td>
                    <td>{{$new->summary}}</td>
                    <!-- <td>{{$new->content}}</td> -->
                    <td>{{$new->author}}</td>
                    <td>{{$new->created_at}}</td>
                    <td>{{$new->updated_at}}</td>
                    @csrf
                    <td><a href="{{route('editNews',['id'=>$new->id])}}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                    <td><button id="{{$new->id}}" class=" remove btn btn-danger"><i class="fa fa-trash"></i></button></td>
                     <!-- <td></td> -->
                    <!-- <td> <a href="" class="btn btn-success">update</a> </td> -->
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
    $(document).on('click',".remove",function(){
        var id=$(this).attr('id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "{{route('deleteNew')}}",
            data:{id:id,_token:_token},
            success: function (response) {
                $('#row'+id).remove();
                alert(response.success);
            }
        });
    });
  });
  </script>
  @endsection('content')
