@extends('layout.general_layout')

<title>@yield('title', 'Survey Response Counts')</title>

@section('content')

<div class="container-fluid p-5" style="width: 95%;">
    <h2 class="mb-4">Survey Response Summary</h2>
    
    <!-- External Services Survey Summary -->
    <h3>External Services Survey Summary</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>1 (Strongly Disagree)</th>
                <th>2 (Disagree)</th>
                <th>3 (Neutral)</th>
                <th>4 (Agree)</th>
                <th>5 (Strongly Agree)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($externalCounts as $sqd => $scores)
                <tr>
                    <td>{{ strtoupper($sqd) }}</td>
                    @foreach ($scores as $score => $count)
                        <td>{{ $count }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <!-- Overall Total Row for External -->
        <tfoot>
            <tr>
                <td><strong>Overall Total (External)</strong></td>
                @foreach ($overallExternalCounts as $score => $count)
                    <td><strong>{{ $count }}</strong></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
    
    <!-- Internal Services Survey Summary -->
    <h3>Internal Services Survey Summary</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>1 (Strongly Disagree)</th>
                <th>2 (Disagree)</th>
                <th>3 (Neutral)</th>
                <th>4 (Agree)</th>
                <th>5 (Strongly Agree)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($internalCounts as $sqd => $scores)
                <tr>
                    <td>{{ strtoupper($sqd) }}</td>
                    @foreach ($scores as $score => $count)
                        <td>{{ $count }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <!-- Overall Total Row for Internal -->
        <tfoot>
            <tr>
                <td><strong>Overall Total (Internal)</strong></td>
                @foreach ($overallInternalCounts as $score => $count)
                    <td><strong>{{ $count }}</strong></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>

@endsection
