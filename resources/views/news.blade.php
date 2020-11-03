@extends('Layout\master')
@section('content')
<div class="container">
    <div class="row">
        <h1>{{$newsById->title}}</h1>
    </div>
    <div class="row">
        <div class="col-sm-8 text-justify">
            <p>{!!$newsById->content!!}</p>
        </div>
        <div class="col-sm-4 ">
            <div class="card">
                <div class="card-header bg-red border " style="background-color:red">
                    <h3 class="text-white">Tin mới cập nhật</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                    @foreach($news as $data)
                        <li class="list-group-item">
                            <a href=""><img src="{{URL::asset('images/'.$data->image)}}" alt=""></a>
                            <a href=""><h4>{{$data->title}}</h4></a>
                            <p>{{$data->summary}}</p>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
