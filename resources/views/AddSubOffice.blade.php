@extends('layout.general_layout')

@section('title', 'Add Sub Office')

@section('content')
<div class="wrapper">
    
<div class="content" > 
<div class="container mt-5">
    <div class="card shadow-lg">
    <div class="card-header text-white  " style="background-color: #2c2c2c;">
    <h3>Adding Sub Office to <b> {{ $mainOffice->office_name }}</b></h3>
    </div>
     
    <div class="card-body">
    <form action="{{ route('subOffice.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="sub_office_name" class="form-label">Sub Office Name  

            </label>
            <input type="text" class="form-control" id="sub_office_name" name="sub_office_name" required>
            <input type="hidden" class="form-control" id="main_office_id" name="main_office_id"  value=" {{ $mainOffice->office_id }}"  >
      
      
        </div>
        <div class="mb-3">
            <label for="sub_office_name" class="form-label">Office Admin 
          
            </label>  <input type="text" class="form-control" id="sub_office_admin" name="sub_office_admin" required>

        </div>
        

        <button type="submit" class="btn btn-primary">Save Sub Office</button>

        <!-- <a href="{{ route('subOffices.show', $mainOffice->office_id) }}" class="btn btn-secondary">Cancel</a> -->
        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
    </div>
</div>
</div>
@endsection
