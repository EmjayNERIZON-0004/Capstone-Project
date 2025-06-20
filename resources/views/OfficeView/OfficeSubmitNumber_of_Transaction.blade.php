@extends('layout.layout_office')

<title>@yield('title','Generate Transaction No.')</title>

@section('content')

<style> 
    .container {
        max-width: 600px;
    }
    .card {
        border: none;
        border-radius: 5px;
      
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-generate {
        background-color: rgb(4, 59, 125);
        border: none; 
        color: white;
        transition: transform 0.2s ease-in-out;
    }
    .btn-generate:disabled {
        background-color: gray;
        cursor: not-allowed;
    }
    .btn-generate:hover {
        background-color: rgb(4, 59, 125);

        transform: scale(1.05);
        color: white;
    }
</style>

<div class="container pt-3 pb-5">
    @include ('components.alert')
    <!-- <header class="header">
    <h4 class="office-name">{{ session('office_name') }}</h4>
</header> -->

<!-- Display submitted transaction if it exists -->
@if($existingRecord)
<div class="card shadow-lg p-4 mb-4 " 
    style="border-left: 8px solid rgb(121, 121, 121); border-radius: 12px;">
    
    <div class="d-flex align-items-center">
        <div class="icon-box  text-white d-flex align-items-center justify-content-center" 
            style="width: 50px; height: 50px; border-radius: 50%;background-color:rgb(4, 59, 125)">
            <i class="fas fa-file-alt fa-lg"></i>
        </div>

        <h4 class="fw-bold ms-3 mb-0" style="color: rgb(70, 70, 70);">Submitted Transactions</h4>
    </div>

    <hr class="my-3">
  <style>
    img {
        width: 100%;
        max-width: 200px;
        height: auto;
        margin-bottom: 5px;
    }

    @media (max-width: 576px) {
        img {
            max-width: 100px;  /* Smaller image for mobile */
        }
    }
</style>

    <img src="{{ asset('undraw_data-processing_z2q6.svg') }}" alt="SVG Image" >

    <style>
    /* Hover Effect */
    .highlight-card {
    transition: all 0.3s ease-in-out;
    border-radius: 12px; /* Smooth edges */
    border: 2px solid lightgray;
    box-shadow: 2px 4px 10px rgba(239, 239, 239, 0.3); /* Default shadow */
}

.highlight-card:hover {
    transform: scale(1.05); /* Slight Zoom */
    box-shadow: 4px 8px 20px rgba(4, 59, 125, 0.5); /* Glow Effect */
    
}

</style>

<div class="row">
    <!-- Month & Year Card -->
    <div class="col-md-6">
        <div class="card text-center shadow-sm p-3 highlight-card"  > 
            <div class="d-flex align-items-center justify-content-center">
                <i class="far fa-calendar-alt text-secondary" style="font-size: 2rem;"></i>
            </div>
            <p class="text-muted mt-2 mb-0">Month & Year</p>
            <h5 class="fw-bold">{{ $existingRecord->month_year }}</h5>
        </div>
    </div>

    <!-- Total Transactions Card -->
    <div class="col-md-6">
        <div class="card text-center shadow-sm p-3 highlight-card">
            <div class="d-flex align-items-center justify-content-center">
                <i class="fas fa-chart-line text-success" style="font-size: 2rem;"></i>
            </div>
            <p class="text-muted mt-2 mb-0">Total Transactions</p>
            <h5 class="fw-bold">{{ $existingRecord->number_transaction }}</h5>
        </div>
    </div>
</div>
</div>  
@endif


    <div class="card p-4">
    <style>
    img {
        width: 100%;
        max-width: 200px;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }

    @media (max-width: 576px) {
        img {
            max-width: 100px;  /* Smaller image for mobile */
        }
    }
</style>


<h3 class="mb-4 fw-bold text-center" style="color: rgb(70, 70, 70);">Submit Number of Transactions</h3>
<img src="{{ asset('undraw_server-push_1lbi.svg') }}" alt="SVG Image" >
<?php
  if($existingRecord){
    echo '<p class="text-muted">You have submitted the number of transaction.</p>';
  } 
?>

        <form action="{{ route('submit.transaction') }}" method="POST">
            @csrf

            <input type="hidden" name="main_office_id" value="{{ session('office_id') }}">
            
            <!-- Month & Year -->
            <div class="mb-3">
                <label for="monthYearInput" class="form-label fw-semibold">Month & Year</label>
                <div class="input-group">
                    <input type="text" id="monthYearInput" name="month_year" class="form-control styled-input" value="{{ $currentMonthYear }}" readonly>
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>

            <!-- Total Transactions -->
            <div class="mb-3">
                <label for="transactionInput" class="form-label fw-semibold">Total Transactions</label>
                <div class="input-group">
                    <input type="number" id="transactionInput" name="number_transaction" class="form-control styled-input" placeholder="Enter total transactions" required {{ $existingRecord ? 'disabled' : '' }}>
                    <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                </div>
            </div>

            <button type="submit" class="btn btn-generate w-100 mt-3" {{ $existingRecord ? 'disabled' : '' }}>
                <b>Submit</b>
            </button>
        </form>
    </div>
</div>

@endsection
