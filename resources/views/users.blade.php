@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @include('alerts.alert-notification')
                    <div class="my-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-lg-8 mr-0 p-1">
                                            <select name="status" id="filter" class="form-control">
                                                <option value="" selected disabled>Filter Status...</option>
                                                <option value="active" @if(request()->status == 'active') selected @endif>Active</option>
                                                <option value="pending" @if(request()->status == 'pending') selected @endif>Pending</option>
                                                <option value="suspended" @if(request()->status == 'suspended') selected @endif>Suspended</option>
                                            </select>
                                        </div>
                                            
                                        <div class="col-lg-4 ml-0 p-1">
                                            <button type="submit" class="btn btn-primary">
                                                Apply
                                            </button>
                                        </div>

                                        @if (request()->status)
                                            <div class="col-lg-4 ml-0 p-1 mt-2">
                                                <a href="{{ route('users') }}" class="btn btn-danger">
                                                    Reset
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users->all()))
                                    @php $counter = 0 @endphp
                                    @foreach ($users as $user)
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
                                            <td>
                                                @if ($user->status == 'pending')
                                                    <a href="{{ route('activate-user', $user->id) }}" class="btn btn-success btn-sm m-1 actiavte-user">
                                                        Activate
                                                    </a>

                                                    <a href="{{ route('suspend-user', $user->id) }}" class="btn btn-danger btn-sm m-1 suspend-user">
                                                        Suspend
                                                    </a>
                                                @elseif ($user->status == 'active')
                                                    <a href="{{ route('suspend-user', $user->id) }}" class="btn btn-danger btn-sm suspend-user">
                                                        Suspend
                                                    </a>
                                                @elseif ($user->status == 'suspended')
                                                    <a href="{{ route('activate-user', $user->id) }}" class="btn btn-success btn-sm actiavte-user">
                                                        Activate
                                                    </a>
                                                @else
                                                    - - -
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

                    {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function(e){
        $("body").on("click", ".actiavte-user", function(e){
            if (!confirm("Are you sure you want to activate this user?")) e.preventDefault();
        });

        $("body").on("click", ".suspend-user", function(e){
            if (!confirm("Are you sure you want to suspend this user?")) e.preventDefault();
        });
    });
</script>
@endsection