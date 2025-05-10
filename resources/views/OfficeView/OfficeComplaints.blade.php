@extends('layout.layout_office')

@section('title', 'Approved Complaints')

@section('content')
<div class="container pt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="fas fa-comments text-danger"></i> Complaints Received</h5>
            <a href="{{ route('dashboard_with_score') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            @if($complaints->isEmpty())
                <div class="alert alert-secondary text-center" role="alert">
                    <i class="fas fa-info-circle"></i> No complaints found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Remarks</th>
                                <th>Date</th>
                                <th class="d-none d-md-table-cell">Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaints as $index => $complaint)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-muted">{{ $complaint->remarks }}</td>
                                <td class="text-muted">{{ \Carbon\Carbon::parse($complaint->created_at)->format('F d, Y - h:i A') }}</td>
                                <td class="d-none d-md-table-cell"> 
                                    <button class="btn btn-success">Generate Recommendations</button>
                                </td>
                            </tr>
                            <!-- Mobile View (Move button below, spanning all columns) -->
                            <tr class="d-md-none">
                                <td colspan="3" class="text-center">
                                    <button class="btn btn-success w-100">Generate Recommendations</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
