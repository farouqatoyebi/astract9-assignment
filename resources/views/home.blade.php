@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome to your dashboard, '.auth()->user()->name.'!') }}
                </div>
            </div>

            <div class="mt-4 border shadow p-3">
                <h5 class="h5 text-muted">
                    Tasks
                </h5>
                <hr>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="card text-center">
                            <div class="card-header bg-dark text-white">Total Tasks</div>
                            <div class="card-body">
                                <h5 class="h5 font-weight-bolder">{{ number_format($data['totalTasks']) }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card text-center">
                            <div class="card-header bg-warning text-white">Pending Tasks</div>
                            <div class="card-body">
                                <h5 class="h5 font-weight-bolder">{{ number_format($data['totalPendingTasks']) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card text-center">
                            <div class="card-header bg-success text-white">Done Tasks</div>
                            <div class="card-body">
                                <h5 class="h5 font-weight-bolder">{{ number_format($data['totalDoneTasks']) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card text-center">
                            <div class="card-header bg-danger text-white">Overdue Tasks</div>
                            <div class="card-body">
                                <h5 class="h5 font-weight-bolder">{{ number_format($data['totalOverDueTasks']) }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 border shadow p-3">
                <h5 class="h5 text-muted">
                    Recent tasks
                </h5>
                
                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="table-responsive">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter = 0 @endphp
                                            @if (count($lastFiveTasks->all()))
                                                @foreach ($lastFiveTasks as $lastFiveTask)
                                                    <tr>
                                                        <td>{{ ++$counter }}</td>
                                                        <td>{{ $lastFiveTask->title }}</td>
                                                        <td>{{ $lastFiveTask->category->title ?? '' }}</td>
                                                        @role('admin')
                                                            <td>{{ $lastFiveTask->user->name }}</td>
                                                        @endrole
                                                        <td>{{ \Carbon\Carbon::parse($lastFiveTask->deadline)->format('F jS, Y') }}</td>
                                                        <td>
                                                            @if ($lastFiveTask->status == 'done')
                                                                <span class="badge bg-success rounded-pill">Done</span>
                                                            @elseif ($lastFiveTask->status == 'pending')
                                                                @if ($lastFiveTask->deadline < date("Y-m-d"))
                                                                    <span class="badge bg-danger rounded-pill">Overdue</span>
                                                                @else
                                                                    <span class="badge bg-warning rounded-pill">Pending</span>
                                                                @endif
                                                            @elseif ($lastFiveTask->status == 'overdue')
                                                                <span class="badge bg-danger rounded-pill">Overdue</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7">
                                                        <p class="text-center mb-0">No record found</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('user-tasks') }}" class="text-center btn btn-link text-decoration-none text-success">View all tasks <i class="fa fa-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @role('admin')
                <div class="mt-4 border shadow p-3">
                    <h5 class="h5 text-muted">
                        Users
                    </h5>
                    <hr>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card text-center">
                                <div class="card-header bg-dark text-white">Total Users</div>
                                <div class="card-body">
                                    <h5 class="h5 font-weight-bolder">{{ number_format($data['totalUsers']) }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card text-center">
                                <div class="card-header bg-warning text-white">Pending Users</div>
                                <div class="card-body">
                                    <h5 class="h5 font-weight-bolder">{{ number_format($data['totalPendingUsers']) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card text-center">
                                <div class="card-header bg-success text-white">Active Users</div>
                                <div class="card-body">
                                    <h5 class="h5 font-weight-bolder">{{ number_format($data['totalActiveUsers']) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card text-center">
                                <div class="card-header bg-danger text-white">Suspended Users</div>
                                <div class="card-body">
                                    <h5 class="h5 font-weight-bolder">{{ number_format($data['totalSuspendedUsers']) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="mt-4 border shadow p-3">
                    <h5 class="h5 text-muted">
                        Recent Users
                    </h5>
                    
                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($lastFiveUsers->all()))
                                                    @php $counter = 0 @endphp
                                                    @foreach ($lastFiveUsers as $user)
                                                        <tr>
                                                            <td>{{ ++$counter }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F jS, Y h:ia') }}</td>
                                                            <td>
                                                                @if ($user->status == 'pending')
                                                                    <span class="badge rounded-pill bg-warning">{{ $user->status }}</span>
                                                                @elseif ($user->status == 'active')
                                                                    <span class="badge rounded-pill bg-success">{{ $user->status }}</span>
                                                                @elseif ($user->status == 'suspended')
                                                                    <span class="badge rounded-pill bg-danger">{{ $user->status }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7">
                                                            <p class="text-center mb-0">No record found</p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('users') }}" class="text-center btn btn-link text-decoration-none text-success">View all users <i class="fa fa-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>
</div>
@endsection
