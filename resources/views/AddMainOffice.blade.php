@extends('layout.general_layout')

@section('content')
<div class="wrapper">
    <div class="content" >
        
<div class="container mt-4">
    <div class="card shadow-lg">
    <div class="card-header text-white  " style="background-color: #2c2c2c;">
    <h4>Add Main Office</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('mainOffice.store') }}" method="POST">
                @csrf

                <!-- Main Office ID -->
                <div class="mb-3">
                    <label for="office_id" class="form-label">Main Office ID</label>
               
                    <input type="text" class="form-control @error('office_id') is-invalid @enderror" 
                           id="office_id" name="office_id" value="{{ old('office_id') }}" required>
                    @error('main_office_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Office Name -->
                <div class="mb-3">
                    <label for="office_name" class="form-label">Office Name</label>
                    <input type="text" class="form-control @error('office_name') is-invalid @enderror" 
                           id="office_name" name="office_name" value="{{ old('office_name') }}" required>
                   
                           @error('office_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="office_admin" class="form-label">Office Admin</label>
                    <input type="text" class="form-control @error('office_admin') is-invalid @enderror" 
                           id="office_admin" name="office_admin" value="{{ old('office_admin') }}" required>
                   
                           @error('office_admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Add Office</button>
                     <!-- <a href="{{ route('mainOffice.index') }}" class="btn btn-secondary">Cancel</a> -->
                     <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
