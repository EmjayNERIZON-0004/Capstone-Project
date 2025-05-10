<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SubOffice;
use Carbon\Carbon;
use App\Models\ServiceTransactionCount;
use App\Models\survey_responses;

class ServiceTransactionCountController extends Controller
{
    

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'transaction_count' => 'required|integer|min:0',
        ]);

        // Get the current quarter and year
        $currentQuarter = Carbon::now()->quarter;
        $currentYear = Carbon::now()->year;

        // Check if the service already has a transaction record for this quarter
        $existingTransaction = ServiceTransactionCount::where('service_id', $request->service_id)
            ->where('quarter', $currentQuarter)
            ->where('year', $currentYear)
            ->first();

        // If already submitted, show error message
        if ($existingTransaction) {
            return redirect()->back()->with('error', 'Transaction count for this service has already been submitted for this quarter.');
        }
  
        // Store the new transaction count for the current quarter and year
        ServiceTransactionCount::create([
            'service_id' => $request->service_id,
            'transaction_count' => $request->transaction_count,
            'quarter' => $currentQuarter,  // Store the quarter
            'year' => $currentYear,  // Store the year
            'month_year' => Carbon::now()->format('F Y'),  // Optional: Store the month and year
        ]);
 
 
 
        // Redirect with success message
        return redirect()->back()->with('success', 'Transaction count successfully submitted for the current quarter.');
    }
}
