@extends('admin/layout/master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
    @if(session()->has('errors'))
    <div class="alert alert-danger">
        <ul>
            {{session('errors')}}
        </ul>
    </div>
    @endif
   
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
            <form action="{{route('fileImport')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group  row">
                  <label for="">file</label>
                  <input type="file" class="form-control-file " name="csv_file" id="csv_file" placeholder="" aria-describedby="fileHelpId">
                  <!-- <small id="fileHelpId" class="form-text text-muted">Help text</small> -->
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">import</button>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>
@endsection
