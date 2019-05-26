@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session('status'))
        <div class="row justify-content-center">
            <div class="col-md-8 card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        @foreach($allTasks as $task)
            <div class="col-md-12 card">
                <p class="font-size: 350%">{{$task->name}}</p>
                <p>{{$task -> taskText}}</p>
                @if ($isDone[$task -> id])
                <p>{{$task->answer}}</p>
                <span class="badge badge-success col-md-3">Верно</span><br>
                @else
                    <small class="form-text text-muted">Вы пока не решили данную задачу</small><br>
                    <form>
                        <div class="form-group">
                            <input name="answer" class="form-control" type="text" placeholder="Ответ">
                            <input name="taskId" type="hidden" value="{{$task->id}}"><br><br>
                            <input type="submit" value="Отправить" class="btn btn-primary">
                        </div>
                    </form>
                @endif
            </div><br>
        @endforeach
    </div>
@endsection
