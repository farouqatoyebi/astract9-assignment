@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Task Category') }}</div>

                <div class="card-body">
                    @include('alerts.alert-notification')
                    <a href="{{ route('admin-task-categories') }}" class="btn btn-danger my-3">
                        Back
                    </a>

                    <form action="{{ route('modify-task-category', ['id' => $taskCategory->id]) }}" method="post" class="form" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <p class="font-weight-bold">{{ $taskCategory->title }}</p>
                            <hr>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control custom-select @error('status') is-invalid @enderror" required>
                                <option value="" selected disabled>--Choose a status--</option>
                                <option value="" disabled>- - - -</option>
                                <option value="active" @if(old('status', $taskCategory->status) == 'active') selected @endif>Active</option>
                                <option value="inactive" @if(old('status', $taskCategory->status) == 'inactive') selected @endif>Not Active</option>
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button class="btn btn-secondary" type="submit">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection