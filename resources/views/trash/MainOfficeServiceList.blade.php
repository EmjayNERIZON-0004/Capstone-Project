@extends('layout.general_layout')

@section('title', 'Main Office Services')

@section('content')
@include ('components.alert')
<div class="wrapper">
    <div class="content" >
        <div class="container mt-5">
            <div class="card shadow-lg">
                <!-- Header -->
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">{{ $mainOffice->office_name }} - Services</h3>
                </div>

                <!-- Body -->
                <div class="card-body">
                      <h5 class="fw-bold">List of Services</h5>
                        <a href="{{route('servicesAvailed.createForMainOffice', $mainOffice->id) }}" 
                           class="btn btn-primary btn-sm mb-3">
                            + Add New Service
                        </a>
                    <br>

                    <!-- Services Table -->
                    @if($services->isEmpty())
                        <div class="alert alert-warning text-center">
                            No services available for this Main Office.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped  ">
                                <thead class="table-dark">
                                    <tr>
                                    
                                        <th>Service Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $index => $service)
                                        <tr>
                                           
                                            <td>{{ $service->service_name }}</td>
                                            <td>
                                            <a href="{{ route('servicesAvailed.edit', $service->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                                <form action="{{ route('servicesAvailed.destroy', $service->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Are you sure you want to delete this service?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Back Button -->
                     
                        <a href="{{ route('mainOffice.index') }}" class="btn btn-secondary btn-sm">Back to Main Offices</a>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
