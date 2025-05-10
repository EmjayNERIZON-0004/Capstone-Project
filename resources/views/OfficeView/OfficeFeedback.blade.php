@extends('layout.general_layout')

@section('title', 'Feedbacks for ' . $office_name)

@section('content')
<div class="content"> 
    <div class="wrapper">
<div class="container my-4">
    <h2 class="text-center">Feedbacks for {{ $office_name }}</h2>

    @if($feedbacks->isEmpty())
        <div class="alert alert-secondary text-center" role="alert">
            <i class="fas fa-info-circle"></i> No feedbacks available for this office.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>Feedback Received</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $feedback->office_transacted_with }}</td>
                        <td>{{ $feedback->remarks }}</td>

                        <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('F d, Y - h:i A') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="text-center mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div></div>
</div>
@endsection
