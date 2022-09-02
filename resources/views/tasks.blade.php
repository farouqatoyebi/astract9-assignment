@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    @include('alerts.alert-notification')
                    @role('user')
                        <a href="{{ route('add-user-task') }}" class="btn btn-success my-3 text-right">
                            New Task
                        </a>
                    @endrole

                    <div class="table-responsive">
                        <form action="" method="GET">
                            <div class="row mb-3">
                                @role('admin')
                                    <div class="form-group col">
                                        <input type="text" name="name" class="form-control" value="{{ request()->name }}" placeholder="Name" />
                                    </div>
                                @endrole

                                <div class="form-group col">
                                    <select name="status" id="" class="form-control custom-select">
                                        <option value="">Status</option>
                                        <option value="pending" @if(request()->status == 'pending') selected @endif>Pending</option>
                                        <option value="done" @if(request()->status == 'done') selected @endif>Done</option>
                                        <option value="overdue" @if(request()->status == 'overdue') selected @endif>Overdue</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <input type="submit" class="btn btn-primary" value="Apply Filter" />
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    @role('admin')
                                        <th>User</th>
                                    @endrole
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 0 @endphp
                                @if (count($userTasks->all()))
                                    @foreach ($userTasks as $userTask)
                                        <tr>
                                            <td>{{ ++$counter }}</td>
                                            <td>{{ $userTask->title }}</td>
                                            <td>{{ $userTask->category->title ?? '' }}</td>
                                            @role('admin')
                                                <td>{{ $userTask->user->name }}</td>
                                            @endrole
                                            <td>{{ \Carbon\Carbon::parse($userTask->deadline)->format('F jS, Y') }}</td>
                                            <td>
                                                @if ($userTask->status == 'done')
                                                    <span class="badge bg-success rounded-pill">Done</span>
                                                @elseif ($userTask->status == 'pending')
                                                    @if ($userTask->deadline < date("Y-m-d"))
                                                        <span class="badge bg-danger rounded-pill">Overdue</span>
                                                    @else
                                                        <span class="badge bg-warning rounded-pill">Pending</span>
                                                    @endif
                                                @elseif ($userTask->status == 'overdue')
                                                    <span class="badge bg-danger rounded-pill">Overdue</span>
                                                @endif
                                                @if ($userTask->last_modified_by)
                                                    <p class="text-muted mt-2">
                                                        <small>
                                                            <em><i class="fa fa-info-circle"></i> Last modified by
                                                                @if ($userTask->last_modified_by == 'admin')
                                                                    an Administrator
                                                                @else
                                                                    @role('admin')
                                                                        User
                                                                    @else
                                                                        You
                                                                    @endrole
                                                                @endif
                                                            </em>
                                                        </small>
                                                    </p>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($userTask->created_at)->format('F jS, Y h:ia') }}</td>
                                            <td>
                                                <a href="{{ route('edit-user-task', ['id' => $userTask->id]) }}" class="btn btn-info m-1 btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a href="{{ route('delete-user-task', ['id' => $userTask->id]) }}" class="btn btn-danger m-1 btn-sm confirm-delete-task">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>

                                                @if ($userTask->status == 'done')
                                                    <a href="{{ route('unmark-user-task-done', ['id' => $userTask->id]) }}" class="btn btn-secondary m-1 btn-sm btn-block confirm-unmark-done">
                                                        <i class="fa fa-times-circle"></i> UnMark as Done
                                                    </a>
                                                @else
                                                    <a href="{{ route('mark-user-task-done', ['id' => $userTask->id]) }}" class="btn btn-success m-1 btn-sm btn-block confirm-mark-done">
                                                        <i class="fa fa-check-circle"></i> Mark as Done
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-center mb-0">No record found</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $userTasks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function(e){
        $("body").on("click", ".confirm-delete-task", function(e){
            if (!confirm("Are you sure you want to delete this task?")) e.preventDefault();
        });

        $("body").on("click", ".confirm-mark-done", function(e){
            if (!confirm("Are you sure you want to mark this task as done?")) e.preventDefault();
        });

        $("body").on("click", ".confirm-unmark-done", function(e){
            if (!confirm("Are you sure you want to unmark this task as done?")) e.preventDefault();
        });
    });
</script>
@endsection