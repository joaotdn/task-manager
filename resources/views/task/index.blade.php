@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between"><span>{{ __('Tasks') }}</span> <a href="{{ route('task.create') }}" class="float-right">New</a></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Limit date</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key => $task)
                                    <tr>
                                        <th scope="row">{{ $task['id'] }}</th>
                                        <td>{{ $task['task'] }}</td>
                                        <td>{{ date('d/m/Y', strtotime($task['limit_date'])) }}</td>
                                        <td><a href="{{ route('task.edit', $task['id']) }}">Edit</a></td>
                                        <td>
                                            <form action="{{ route('task.destroy', $task['id']) }}" method="post" id="form_{{ $task['id'] }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" onclick="document.getElementById('form_{{ $task['id'] }}').submit()">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $tasks->previousPageUrl() }}">Previous</a></li>
                                @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                                    <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}"><a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tasks->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
