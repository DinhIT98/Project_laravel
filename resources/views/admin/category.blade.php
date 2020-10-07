@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category</h3>
                <a href="/admin/insert-category-2" class="btn btn-primary float-right mb-1">insert sub_category</a>
                <a href="/admin/insert-category-1" class="btn btn-primary float-right mb-1 mr-5">insert </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Parent_id</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($category as $cate)
                  <tr>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td>{{$cate->level}}</td>
                    <td>{{$cate->parent_id}}</td>
                    <td style ="width:20px"><form action="{{route('deleteCategory',['id'=>$cate->id])}}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                    </form></td>
                    <td style ="width:20px"><a href="{{route('editCategory',['id'=>$cate->id])}}" type='button' class='btn btn-success'><i class="fa fa-edit"></i></a></td>
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
  @endsection('content')
