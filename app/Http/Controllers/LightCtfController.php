<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

function isTaskNew($taskId, $finishedTasks){
    $result = true;

    foreach ($finishedTasks as $finishedTask){
        if ($taskId == $finishedTask) $result = false;
    }

    return $result;
}

class LightCtfController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function generateContestPage (Request $request){

        $finishedUsersTasks = Auth::user() -> tasks() -> pluck('id');
        $isDone = [];
        $allTasks = Task::all();

        if ($request -> has('taskId') && $request -> has('answer')){

            if (($request -> answer === Task::findOrFail($request -> taskId) -> answer) && isTaskNew($request -> taskId, $finishedUsersTasks)){
                Auth::user() -> tasks() -> attach($request -> taskId);
            }

        }
        $finishedUsersTasks = Auth::user() -> tasks() -> pluck('id');
        foreach ($allTasks as $task){
            $isDone[$task -> id] = !isTaskNew($task -> id, $finishedUsersTasks);
        }
        return view('contest', compact("allTasks", "isDone", "finishedUsersTasks"));
    }

    public function generateLeaderBoard(){

        $allUsers = User::all();
        $leaderBoardArray = [];

        foreach ($allUsers as $user) {
            $leaderBoardArray[$user -> name] = $user -> tasks() -> count();
        }
        arsort($leaderBoardArray);
        return view('leaderBoard', compact('leaderBoardArray'));

    }
}
