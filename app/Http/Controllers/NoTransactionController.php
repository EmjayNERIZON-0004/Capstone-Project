<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoTransaction;

class NoTransactionController extends Controller
{
    public function index()
    {
        $mainOfficeId = session('office_id'); // Get from session
        $currentMonthYear = now()->format('F Y'); // Example: "March 2025"

        // Fetch existing record for the current month
        $existingRecord = NoTransaction::where('main_office_id', $mainOfficeId)
            ->where('month_year', $currentMonthYear)
            ->first();

        return view('OfficeView.OfficeSubmitNumber_of_Transaction', compact('existingRecord', 'currentMonthYear'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_office_id' => 'required|string',
            'month_year' => 'required|string',
            'number_transaction' => 'required|integer|min:1',
        ]);

        // Check if a record for this month already exists
        $existingRecord = NoTransaction::where('main_office_id', $request->main_office_id)
            ->where('month_year', $request->month_year)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Transaction data for this month already exists.');
        }

        // Save new transaction entry
        NoTransaction::create([
            'main_office_id' => $request->main_office_id,
            'month_year' => $request->month_year,
            'number_transaction' => $request->number_transaction,
        ]);

        return redirect()->back()->with('success', 'Transaction data submitted successfully.');
    }

    
}
