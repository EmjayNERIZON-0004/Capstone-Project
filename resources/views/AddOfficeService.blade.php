@extends('layout.general_layout')

@section('title', 'Add Office Service')

@section('content')
<div class="wrapper">
    
<div class="content" > 
<div class="container mt-5">
    <div class="card shadow-lg">
        <!-- Header with blue primary background -->
        <div class="card-header text-white" style="background-color: #2c2c2c;">
        <h3 class="mb-0">Add Service to <b> {{ $sub_office->sub_office_name }}</b></h3>
        </div>

        <div class="card-body">
        <form action="{{ route('servicesAvailed.store') }}" method="POST">
    @csrf

    <!-- Hidden Inputs -->
    <input type="hidden" name="sub_office_id" value="{{ $sub_office->id }}">
    <input type="hidden" name="main_office_id" value="{{ $sub_office->main_office_id }}">

    <!-- Service Name Input -->
    <div class="mb-3">
        <label for="service_name" class="form-label">Service Name</label>
        <input type="text" class="form-control" id="service_name" name="service_name" required>
    </div>

    <!-- Service Type Dropdown -->
    <div class="mb-3">
        <label for="service_type" class="form-label">Service Type</label>
        <select class="form-control" id="service_type" name="service_type" required>
            <option value="None" selected>None</option>
            
            <option value="External">External</option>
            <option value="Internal">Internal</option>
            <option value="Both">Both</option>

        </select>
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
