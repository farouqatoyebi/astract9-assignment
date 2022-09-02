@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Categories') }}</div>

                <div class="card-body">
                    @include('alerts.alert-notification')
                    <a href="{{ route('add-new-task-category') }}" class="btn btn-success my-3 text-right">
                        New Task Category
                    </a>

                    <div class="table-responsive">
                        <small class="text-danger">
                            <i class="fa fa-info-circle"></i> NOTE: Inactive categories will not delete tasks under them. They will only not be visible to the user with tasks under them.
                        </small>
                        <hr>
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 0 @endphp
                                @if (count($taskCategories->all()))
                                    @foreach ($taskCategories as $taskcategory)
                                        <tr>
                                            <td>{{ ++$counter }}</td>
                                            <td>{{ $taskcategory->title }}</td>
                                            <td>
                                                @if ($taskcategory->status == 'active')
                                                    <span class="badge bg-success rounded-pill">{{ $taskcategory->status }}</span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill">{{ $taskcategory->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($taskcategory->created_at)->format('F jS, Y h:ia') }}</td>
                                            <td>
                                                <a href="{{ route('edit-task-category', ['id' => $taskcategory->id]) }}" class="btn btn-dark m-1 btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a href="{{ route('delete-task-category', ['id' => $taskcategory->id]) }}" class="btn btn-danger m-1 btn-sm confirm-delete-category">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center mb-0">No record found</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $taskCategories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function(e){
        $("body").on("click", ".confirm-delete-category", function(e){
            if (!confirm("Are you sure you want to delete this category?")) e.preventDefault();
        });
    });
</script>
@endsection