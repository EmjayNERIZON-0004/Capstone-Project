@extends('layout.general_layout')

@section('title', 'Edit Service')

@section('content')
<div class="wrapper">
    <div class="content" >
        <div class="container mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">Edit Service</h3>
                </div>

                <div class="card-body">
                <form action="{{ route('servicesAvailed.update', $id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Service Name Input -->
    <div class="mb-3">
        <label for="service_name" class="form-label fw-bold">Service Name</label>
        <input type="text" class="form-control" id="service_name" name="service_name"
               value="{{ $service_name }}" required>
    </div>

    <!-- Service Type Dropdown -->
    <div class="mb-3">
        <label for="service_type" class="form-label fw-bold">Service Type</label>
        <select class="form-control" id="service_type" name="service_type" required>
            <option value="None" {{ $services_type == 'None' ? 'selected' : '' }}>None</option>
            <option value="External" {{ $services_type == 'External' ? 'selected' : '' }}>External</option>
            <option value="Internal" {{ $services_type == 'Internal' ? 'selected' : '' }}>Internal</option>
            <option value="Both" {{ $services_type == 'Both' ? 'selected' : '' }}>Both</option>
  
        </select>
    </div>

    <!-- Buttons -->
    <button type="submit" class="btn btn-primary">Update Service</button>
    <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
