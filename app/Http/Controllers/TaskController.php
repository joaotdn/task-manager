<?php

namespace App\Http\Controllers;

use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->paginate(10);
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'task' => 'required|min:3|max:200',
        ];
        $feed = [
            'required' => 'The :attribute field is required',
            'task.min' => 'The task name must contain at least 3 characters',
            'task.max' => 'The task name must contain a maximum of 200 characters'
        ];
        $request->validate($rules, $feed);

        $data = $request->all('task', 'limit_date');
        $data['user_id'] = auth()->user()->id;

        $task = Task::create($data);
        // Mail::to(auth()->user()->email)->send(new NewTaskMail($task));
        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task->limit_date = date('d/m/Y', strtotime($task->limit_date));
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if (auth()->user()->id == $task->user_id) {
            return view('task.edit', ['task' => $task]);
        }
        return view('access-denied');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $rules = [
            'task' => 'required|min:3|max:200',
        ];
        $feed = [
            'required' => 'The :attribute field is required',
            'task.min' => 'The task name must contain at least 3 characters',
            'task.max' => 'The task name must contain a maximum of 200 characters'
        ];
        $request->validate($rules, $feed);

        if (!auth()->user()->id == $task->user_id) {
            return view('access-denied');
        }
        
        $task->update($request->all());
        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (!auth()->user()->id == $task->user_id) {
            return view('access-denied');
        }
    
        $task->delete();
        return redirect()->route('task.index');
    }
}
