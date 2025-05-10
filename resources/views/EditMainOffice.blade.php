@extends('layout.general_layout')

@section('title', 'Edit Main Office')

@section('content')
<div class="wrapper">
    <div class="content" > 
        <div class="container mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Edit Main Office</h4>
                </div>

                <div class="card-body">
                <form action="{{ route('mainOffice.update', $mainOffice->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Office ID (Editable) -->
    <div class="mb-3">
        <label for="office_id" class="form-label">Office ID</label>
        <input type="text" class="form-control" id="office_id" name="office_id" value="{{ $mainOffice->office_id }}" required>
    </div>

    <!-- Office Name -->
    <div class="mb-3">
        <label for="office_name" class="form-label">Office Name</label>
        <input type="text" class="form-control" id="office_name" name="office_name" value="{{ $mainOffice->office_name }}" required>
    </div>

    <div class="mb-3">
        <label for="office_admin" class="form-label">Office Admin</label>
        <input type="text" class="form-control" id="office_admin" name="office_admin" value="{{ $mainOffice->office_admin }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Office</button>
    <!-- <a href="{{ route('mainOffice.index') }}" class="btn btn-secondary">Cancel</a> -->
    <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
       
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
