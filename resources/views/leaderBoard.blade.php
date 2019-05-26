@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="card col-12">
        <ul class="list-group list-group-flush">
            @foreach($leaderBoardArray as $name => $result)
                <li class="list-group-item"> {{$name}}        <span class="badge badge-success">{{$result}}</span></li>
            @endforeach
        </ul>
    </div>
    </div>
@endsection