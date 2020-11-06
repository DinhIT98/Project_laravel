@extends('admin/layout/master')
@section('content')
<style>
        .progress { position:relative; width:100%; }
        .bar { background-color: #008000; width:0%; height:20px; }
         .percent { position:absolute; display:inline-block; left:50%; color: #7F98B2;}
   </style>
<div class="content-wrapper">
    <section class="content-header">
    @if(session()->has('success'))
    <div class="alert alert-success">
        <ul>
            {{session('success')}}
        </ul>
    </div>
    @endif
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
            <form action="{{route('restore')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group  row">
                  <label for="">file</label>
                  <input type="file" class="form-control-file " name="file" id="file" placeholder="" aria-describedby="fileHelpId">
                  <!-- <small id="fileHelpId" class="form-text text-muted">Help text</small> -->
                </div>
                <div class="progress">
                        <div class="bar"></div >
                        <div class="percent">0%</div >
                    </div>
                    <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">restore</button>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<script type="text/javascript">
    $(function() {
         $(document).ready(function()
         {
            var bar = $('.bar');
            var percent = $('.percent');

      $('form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            // var percentVal=0;
            // var timer = setInterval(function(){
            // percentVal = percentVal +50+ '%';
            // bar.width(percentVal);
            // // percent.html(percentVal);
            // }, 500);
            var percentVal = percentComplete + '%';

            bar.width(percentVal)
            percent.html(percentVal);w
        },
        complete: function(xhr) {

            alert('File Uploaded Successfully');
            window.location.href = "/admin/restore";
        }
      });
   });
 });
</script>
@endsection
