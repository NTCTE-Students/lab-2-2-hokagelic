@extends('layouts.app')

@section('content')
<div class="container">
    <div class="filters mb-4">
        <form method="GET" action="{{ route('tasks.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="status_filter" class="form-control">
                        <option value="">All Statuses</option>
                        @foreach(App\Models\Task::getStatuses() as $value => $label)
                            <option value="{{ $value }}"
                                {{ request('status_filter') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="sort" class="form-control">
                        <option value="">Sort By</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>
                            Created At
                        </option>
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>
                            Status
                        </option>
                    </select>
                    <select name="direction" class="form-control mt-2">
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>
                            Ascending
                        </option>
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>
                            Descending
                        </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Таблица задач -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ Task::getStatuses()[$task->status] }}</td>
                    <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tasks->appends(request()->query())->links() }}
</div>
@endsection