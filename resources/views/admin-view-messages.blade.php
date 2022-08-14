@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Messages') }}</div>

                <div class="card-body">
                    @include('alerts.alert-notification')
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S/N</th>
                                    <th>Full Name</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date Sent</th>
                                    <th>Time Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 0 @endphp
                                @if (count($messages->all()))
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ ++$counter }}</td>
                                            <td>{{ $message->user->name }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td>{!! nl2br($message->message) !!}</td>
                                            <td>{{ \Carbon\Carbon::parse($message->created_at)->format('F jS, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($message->created_at)->format('h:ia') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center mb-0">No record found</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $messages->links('pagination::bootstrap-4') }}
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