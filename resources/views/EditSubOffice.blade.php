@extends('layout.general_layout')

@section('title', 'Edit Sub Office')

@section('content')
<div class="wrapper">
    <div class="content" > 
        <div class="container mt-5">
            <div class="card shadow-lg">
                <!-- Dark Gray Header -->
                <div class="card-header bg-dark text-white  ">
                    <h4 class="mb-0">Edit Sub Office for <b> {{$subOffice->main_office_id}} </b></h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('subOffice.update', $subOffice->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                       
                        <!-- Sub Office Name -->
                        <div class="mb-3">
                            <label for="sub_office_name" class="form-label fw-bold">Sub Office Name</label>
                            <input type="text" class="form-control" id="sub_office_name" name="sub_office_name" 
                                value="{{ $subOffice->sub_office_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="office_admin" class="form-label fw-bold"> Office Admin</label>
                            <input type="text" class="form-control" id="office_admin" name="office_admin" 
                                value="{{ $subOffice->office_admin }}" required>
                        </div>
                        <input type="hidden" value="{{$subOffice->main_office_id}}" name="main_office_id">
                        <!-- Buttons -->
                        <button type="submit" class="btn btn-primary">Update Sub Office</button>
                        <!-- <a href="{{ route('subOffices.show', $subOffice->main_office_id) }}" class="btn btn-secondary">Cancel</a> -->
                        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
