@extends('layout.general_layout')

@section('title', 'Add Service to Main Office')

@section('content')
<div class="wrapper">
    <div class="content" > 
        <div class="container mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">Add Service to {{ $mainOffice->office_name }}</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('servicesAvailed.store') }}" method="POST">
                        @csrf

                        <!-- Hidden Input for Main Office ID -->
                        <input type="hidden" name="main_office_id" value="{{ $mainOffice->office_id }}">
                        <input type="hidden" name="sub_office_id" value="">

                        <!-- Service Name Input -->
                        <div class="mb-3">
                            <label for="service_name" class="form-label fw-bold">Service Name</label>
                            <input type="text" class="form-control" id="service_name" name="service_name" required>
                        </div>

                        <!-- Buttons -->
                        <button type="submit" class="btn btn-primary">Save Service</button>
                        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
