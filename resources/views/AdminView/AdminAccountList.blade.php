    @extends('layout.general_layout')

    @section('content')
   
   
    <div class="container mt-4 mb-4">
<!-- Accounts Status Dashboard -->
<div class="container mt-4 mb-4">
  <!-- Summary Cards Row -->
  <div class="row">
    <!-- Total Accounts Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
            <div style="background-color:rgb(36, 36, 36); padding: 10px; border-radius: 50%;">

<img src="{{ asset('key.svg') }}" style="width:30px; height:30px;">
</div>
            </div>
          </div>
          <h3 class="fw-bold">{{ count($mainOffices) + count($subOffices) }}</h3>
          <h6 class="text-muted">Total Accounts</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-primary" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Main Offices Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
            <div style="background-color:rgb(0, 85, 170); padding: 10px; border-radius: 50%;">

<img src="{{ asset('office-building.svg') }}" style="width:30px; height:30px;">
</div>
            </div>
          </div>
          <h3 class="fw-bold">{{ count($mainOffices) }}</h3>
          <h6 class="text-muted">Main Offices</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-primary" style="width: <?= (count($mainOffices) / (count($mainOffices) + count($subOffices))) * 100 ?>%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Sub Offices Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-secondary bg-opacity-10 p-3">
            <div style="background-color:rgb(106, 106, 106); padding: 10px; border-radius: 50%;">

<img src="{{ asset('section-building.svg') }}" style="width:30px; height:30px;">
</div>
            </div>
          </div>
          <h3 class="fw-bold">{{ count($subOffices) }}</h3>
          <h6 class="text-muted">Sub Offices (Sections)</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-secondary" style="width: <?= (count($subOffices) / (count($mainOffices) + count($subOffices))) * 100 ?>%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Activated Accounts Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-success bg-opacity-10 p-3">
            <div style=" border-radius: 50%; ">
                        <img src="{{ asset('check.svg') }}" style="width:40px; height:40px;">
                    </div>
            </div>
          </div>
          @php
            $activatedMainOffices = $mainOffices->where('activation_status', 'Activated')->count();
            $activatedSubOffices = $subOffices->where('activation_status', 'Activated')->count();
            $totalActivated = $activatedMainOffices + $activatedSubOffices;
            $totalAccounts = count($mainOffices) + count($subOffices);
            $activationPercentage = $totalAccounts > 0 ? ($totalActivated / $totalAccounts) * 100 : 0;
          @endphp
          <h3 class="fw-bold">{{ $totalActivated }}</h3>
          <h6 class="text-muted">Activated Accounts</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-success" style="width: <?php echo $activationPercentage ?>%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Activation Status Row -->
  <div class="row">
    <!-- Main Offices Activation Status -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
          <h6 class="fw-bold mb-0"><i class="fas fa-landmark text-secondary me-2"></i>Main Offices Activation</h6>
          <!-- <button class="btn btn-sm btn-outline-primary">Export Data</button> -->
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <div style="height: 180px; width: 180px; position: relative;">
              @php
                $mainOfficesCount = count($mainOffices);
                $mainOfficesActivationPercentage = $mainOfficesCount > 0 
                  ? round(($activatedMainOffices / $mainOfficesCount) * 100) 
                  : 0;
              @endphp
              <div class="position-absolute top-50 start-50 translate-middle text-center">
                <h3 class="mb-0 fw-bold">{{ $mainOfficesActivationPercentage }}%</h3>
                <p class="mb-0 small text-muted">Activated</p>
              </div>
              <svg viewBox="0 0 36 36" class="circular-chart">
                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                <path class="circle" stroke-dasharray="{{ $mainOfficesActivationPercentage }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
              </svg>
            </div>
          </div>
          <div class="mt-3">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <span class="badge bg-success me-1">●</span> Activated
              </div>
              <div class="fw-bold">{{ $activatedMainOffices }} Offices</div>
            </div>
            <div class="d-flex justify-content-between">
              <div>
                <span class="badge bg-danger me-1">●</span> Not Activated
              </div>
              <div class="fw-bold">{{ count($mainOffices) - $activatedMainOffices }} Offices</div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-0">
          <a href="#mainOfficesTable" class="btn btn-sm btn-primary w-100">View Details</a>
        </div>
      </div>
    </div>
    
    <!-- Sub Offices Activation Status -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
          <h6 class="fw-bold mb-0"><i class="fas fa-sitemap text-secondary me-2"></i>Sub Offices Activation</h6>
          <!-- <button class="btn btn-sm btn-outline-primary">Export Data</button> -->
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <div style="height: 180px; width: 180px; position: relative;">
              @php
                $subOfficesCount = count($subOffices);
                $subOfficesActivationPercentage = $subOfficesCount > 0 
                  ? round(($activatedSubOffices / $subOfficesCount) * 100) 
                  : 0;
              @endphp
              <div class="position-absolute top-50 start-50 translate-middle text-center">
                <h3 class="mb-0 fw-bold">{{ $subOfficesActivationPercentage }}%</h3>
                <p class="mb-0 small text-muted">Activated</p>
              </div>
              <svg viewBox="0 0 36 36" class="circular-chart">
                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                <path class="circle" stroke-dasharray="{{ $subOfficesActivationPercentage }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
              </svg>
            </div>
          </div>
          <div class="mt-3">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <span class="badge bg-success me-1">●</span> Activated
              </div>
              <div class="fw-bold">{{ $activatedSubOffices }} Sections</div>
            </div>
            <div class="d-flex justify-content-between">
              <div>
                <span class="badge bg-danger me-1">●</span> Not Activated
              </div>
              <div class="fw-bold">{{ count($subOffices) - $activatedSubOffices }} Sections</div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-0">
          <a href="#subOfficesTable" class="btn btn-sm btn-primary w-100">View Details</a>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Quick Stats Row -->
  <div class="row">
    <!-- Office Types Distribution -->
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-white border-0">
          <h6 class="fw-bold mb-0"><i class="fas fa-chart-pie text-secondary me-2"></i>Activation Overview</h6>
        </div>
        <div class="card-body d-flex align-items-center justify-content-center">
          <div class="text-center">
            <div class="d-flex align-items-center justify-content-center mb-3">
              <div class="me-4">
                <div class="d-flex align-items-center mb-2">
                  <span class="badge rounded-pill bg-success me-2" style="width: 30px; height: 10px;"></span>
                  <span>Activated</span>
                </div>
                <h4 class="fw-bold">{{ $totalActivated }}</h4>
              </div>
              <div>
                <div class="d-flex align-items-center mb-2">
                  <span class="badge rounded-pill bg-danger me-2" style="width: 30px; height: 10px;"></span>
                  <span>Not Activated</span>
                </div>
                <h4 class="fw-bold">{{ $totalAccounts - $totalActivated }}</h4>
              </div>
            </div>
            <div class="progress" style="height: 20px;">
              <div class="progress-bar bg-success" style="width: <?= $activationPercentage ?>%">
                {{ round($activationPercentage) }}%
              </div>
              <div class="progress-bar bg-danger" style="width: <?= 100 - $activationPercentage ?>%">
                {{ round(100 - $activationPercentage) }}%
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Main vs Sub Distribution -->
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-white border-0">
          <h6 class="fw-bold mb-0"><i class="fas fa-building text-secondary me-2"></i>Office Type Distribution</h6>
        </div>
        <div class="card-body d-flex align-items-center justify-content-center">
          @php
            $mainOfficePercent = $totalAccounts > 0 ? (count($mainOffices) / $totalAccounts) * 100 : 0;
            $subOfficePercent = $totalAccounts > 0 ? (count($subOffices) / $totalAccounts) * 100 : 0;
          @endphp
          <div class="text-center w-100">
            <div class="d-flex align-items-center justify-content-center mb-3">
              <div class="me-4">
                <div class="d-flex align-items-center mb-2">
                  <span class="badge rounded-pill bg-primary me-2" style="width: 30px; height: 10px;"></span>
                  <span>Main Offices</span>
                </div>
                <h4 class="fw-bold">{{ count($mainOffices) }}</h4>
              </div>
              <div>
                <div class="d-flex align-items-center mb-2">
                  <span class="badge rounded-pill bg-secondary me-2" style="width: 30px; height: 10px;"></span>
                  <span>Sub Offices</span>
                </div>
                <h4 class="fw-bold">{{ count($subOffices) }}</h4>
              </div>
            </div>
            <div class="progress" style="height: 20px;">
              <div class="progress-bar bg-primary" style="width: <?= $mainOfficePercent ?>%">
                {{ round($mainOfficePercent) }}%
              </div>
              <div class="progress-bar bg-secondary" style="width: <?= $subOfficePercent ?>%">
                {{ round($subOfficePercent) }}%
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Activation Rate -->
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-white border-0">
          <h6 class="fw-bold mb-0"><i class="fas fa-tachometer-alt text-secondary me-2"></i>Activation Rate</h6>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-muted">Main Offices</span>
            <span class="fw-bold">{{ $mainOfficesActivationPercentage }}%</span>
          </div>
          <div class="progress mb-3" style="height: 8px;">
            <div class="progress-bar bg-primary" style="width: <?php echo $mainOfficesActivationPercentage ?>%"></div>
          </div>
          
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-muted">Sub Offices</span>
            <span class="fw-bold">{{ $subOfficesActivationPercentage }}%</span>
          </div>
          <div class="progress mb-3" style="height: 8px;">
            <div class="progress-bar bg-secondary" style="width: <?= $subOfficesActivationPercentage ?>%"></div>
          </div>
          
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-muted">Overall</span>
            <span class="fw-bold">{{ round($activationPercentage) }}%</span>
          </div>
          <div class="progress" style="height: 8px;">
            <div class="progress-bar bg-success" style="width: <?= $activationPercentage ?>%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .card {
    border-radius: 10px;
    border: 1px solid #eee;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }
  
  .progress {
    border-radius: 10px;
    background-color: #f5f5f5;
  }
  
  .progress-bar {
    border-radius: 0px;
  }
  
  .card-header {
    padding: 1rem 1.25rem;
  }
  
  .rounded-circle {
    height: 50px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .circular-chart {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
  }
  
  .circle-bg {
    fill: none;
    stroke: #eee;
    stroke-width: 2.8;
  }
  
  .circle {
    fill: none;
    stroke-width: 2.8;
    stroke-linecap: round;
    stroke: #4CAF50;
  }
</style>
   
    <div class="container mt-3 mb-0 " style="padding-top:1px;">

    
        <div class="container p-3 bg-white" style=" border:1px solid #ddd;border-radius: 5px;">

    <div style="background-color:rgb(20, 160, 88); width:fit-content;height:60px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
    color:white;
    font-size:30px;
    text-align:left;
    padding:10px;
    padding-right:20px;
    transform:translateY(-30px);border-radius:5px;


    margin-left:10px;margin-right:10px"> 
    Accounts Status

    </div>
    

        <h2 id="mainOfficesTable">Main Offices Activation Status</h2>
        <table class="table table-bordered">
            <thead>
                <tr >
                    <th class="bg-light"> Account ID</th>
                    <th class="bg-light">Office</th>
                    <th class="text-center bg-light">Activation Status</th>
                    <th class="text-center bg-light">Reset</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mainOffices as $office)
                    <tr>
                        <td style=" width:150px;">{{ $office->office_id }}</td>
                        <td style=" width:600px;">{{ $office->office_name }}</td>
                        <td class="text-center align-middle"        style="width: 150px;" >
                            @if ($office->activation_status === 'Activated')
                                <span class="badge bg-success">Activated</span>
                            @else
                                <span class="badge bg-danger">Not Activated</span>
                            @endif
                        </td>
                        <td class="text-center align-middle" style="width: 100px;">
                        @if ($office->activation_status === 'Activated')
        <form action="{{ route('account_reset', ['type' => 'office', 'id' => $office->office_id]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-primary" onclick="return confirm('Reset activation for this office?')">Reset</button>
        </form>
        </td>
    @endif

                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5" id="subOfficesTable">Sub Offices (Sections) Activation Status</h2>
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <th class="bg-light">Account ID</th>
                    <th class="bg-light ">Section</th>
                    <th class="text-center bg-light">Activation Status</th>
                    <th class="text-center bg-light">Reset</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subOffices as $section)
                    <tr>
                        <td style=" width:150px;">{{ $section->accountID }}</td>
                        <td  style=" width:600px;">{{ $section->sub_office_name }}</td>
                        <td class="text-center align-middle"    style="width: 150px;">
                            @if ($section->activation_status === 'Activated')
                                <span class="badge bg-success">Activated</span>
                            @else
                                <span class="badge bg-danger">Not Activated</span>
                            @endif
                        </td>
                        <td class="text-center align-middle"    style="width: 100px;">
                        @if ($section->activation_status === 'Activated')
        <form action="{{ route('account_reset', ['type' => 'section', 'id' => $section->accountID]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-primary" onclick="return confirm('Reset activation for this office?')">Reset</button>
        </form>
        </td>
    @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @endsection
