@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Task') }}</div>

                <div class="card-body">
                    @include('alerts.alert-notification')
                    <a href="{{ route('user-tasks') }}" class="btn btn-danger my-3">
                        Back
                    </a>

                    @if (count($taskCategories->all()))
                        <form action="{{ route('submit-user-task') }}" method="post" class="form" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="subject">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" required>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control custom-select @error('category') is-invalid @enderror" required>
                                    <option value="" selected disabled>--Choose a category--</option>
                                    <option value="" disabled>- - - -</option>
                                        @foreach ($taskCategories as $category)
                                            <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                                        @endforeach>
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="deadline">Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}" required />

                                @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control custom-select @error('status') is-invalid @enderror" required>
                                    <option value="" selected disabled>--Choose a status--</option>
                                    <option value="" disabled>- - - -</option>
                                    <option value="pending" @if (old('status') == 'pending') selected @endif>Pending</option>
                                    <option value="done" @if (old('status') == 'done') selected @endif>Done</option>
                                    <option value="overdue" @if (old('status') == 'overdue') selected @endif>Overdue</option>
                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="text-danger"><i class="fa fa-info-circle"></i> Note: If the deadline date set is less than the current date and the status is not set to done, the status is automatically adjusted to Overdue</small>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-secondary" type="submit">
                                    Add Task
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">
                            <div class="card-body text-center">
                                <i class="fa fa-info-circle fa-2x"></i>
                                <p class="mt-3">There are currently no categories available. You will be able to add tasks once an Administrator add new categories.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection