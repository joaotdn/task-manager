@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Task') }}</div>

                    <div class="card-body">
                        <form action="{{ route('task.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="task__name" class="form-label">Task</label>
                                <input type="text" name="task" class="form-control" id="task__name">
                            </div>

                            <div class="mb-3">
                                <label for="task__limite-date" class="form-label">{{ __('Date of conclusion') }}</label>
                                <input type="date" name="limit_date" class="form-control" id="task__limite-date">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('ADD') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
