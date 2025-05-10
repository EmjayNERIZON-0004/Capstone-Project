@extends('layout.general_layout')

<title>@yield('title', 'Admin Dashboard')</title>
@section('content')

<div class="wrapper">
    <div class="content">
        <style>
            table td {
    white-space: normal !important;
    word-wrap: break-word;
    word-break: break-word;
}

            .log-container {
                max-height: 400px;
                overflow-y: scroll;
            }
            .info-log {
                background-color:rgba(0, 123, 255, 0.71); /* Light blue for INFO */
            }
            .warning-log {
                background-color:rgba(255, 204, 0, 0.69); /* Light orange for WARNING */
            }
            .table-container {
                margin-top: 20px;
            }
        </style>

        <div class="container">
            <div style="
                background-color:rgb(255, 255, 255);
                color: #343a40;
                padding: 16px 24px;
                border-left: 5px solid #0d6efd;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                border-radius: 6px;
                margin: 10px 0px;
            ">
                <div style="font-size: 28px; font-weight: 600; margin-bottom: 4px;">
                    Admin Activities
                </div>
                <div style="font-size: 14px; color: #6c757d;">
                    List of Recent Activities of Administrator
                </div>
            </div>

            @if(empty($filteredLogs))
                <div class="alert alert-info" role="alert">
                    No INFO or WARNING logs found.
                </div>
            @else
                <div class="table-container">
                    <!-- Make the table responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            <thead>
                                <tr>
                                    <th style="width: 120px;text-align:center">Log Type</th>
                                    <th>Date&Time</th>
                                   
                                    <th>Log Message</th>
                                </tr>
                            </thead>
                            <tbody>
    @foreach($filteredLogs as $log)
        @php
            // Extract date and time
            preg_match('/\[(.*?)\]\s+\w+\.(INFO|WARNING):\s+(.*)/', $log, $matches);
            $dateTime = $matches[1] ?? '';
            $logType = $matches[2] ?? 'Other';
            $message = $matches[3] ?? $log;

            $isInfo = $logType === 'INFO';
            $isWarning = $logType === 'WARNING';
        @endphp
        <tr>
            <td style="font-weight:600; text-align:center;
                background-color: <?= $isInfo ? 'rgba(0, 123, 255, 0.71);   color: white;' : ($isWarning ? 'rgba(255, 204, 0, 0.69);   color: #333;' : '') ?>;
             ">
                {{ $logType }}
            </td>
            <td style="white-space: nowrap;">{{ $dateTime }}</td>
            <td>{{ $message }}</td>
        </tr>
    @endforeach
</tbody>

                        </table>
                    </div>
                </div>
            @endif
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    </div>
</div>

@endsection
