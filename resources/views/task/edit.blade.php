@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Task') }}</div>

                    <div class="card-body">
                        <form action="{{ route('task.update', ['task' => $task]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="task__name" class="form-label">Task</label>
                                <input type="text" name="task" class="form-control" id="task__name" value="{{ $task->task ?? old('task') }}">
                            </div>

                            <div class="mb-3">
                                <label for="task__limite-date" class="form-label">{{ __('Date of conclusion') }}</label>
                                <input type="date" name="limit_date" class="form-control" id="task__limite-date" value="{{ $task->limit_date ?? old('limit_date') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('SAVE') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
