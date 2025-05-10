<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\survey_responses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SurveyAnalyticsController extends Controller
{
    
public function adminSurveyAnalytics()
{
    return view('AdminView.AdminSurveyAnalytics');
}
public function getData(Request $request)
{
    $now = Carbon::now();
    $quarter = $request->input('quarter'); // This will be the quarter selected in the dropdown
    $year = $request->input('year'); // This will be the year selected in the dropdown

    // If either quarter or year is not provided, use the current quarter and year as defaults
    $quarter = $quarter ?: Carbon::now()->quarter;
    $year = $year ?: Carbon::now()->year;

    // Calculate the start and end of the selected quarter
    $startOfQuarter = Carbon::create($year, ($quarter - 1) * 3 + 1, 1)->firstOfQuarter();
    $endOfQuarter = $startOfQuarter->copy()->lastOfQuarter();

  
// Survey responses grouped by sex with a date range filter
$ageSex = survey_responses::select('sex', DB::raw('count(*) as total'))
->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]) // Apply the date range
->groupBy('sex')
->get();

// Group by customer type with a date range filter
$customerTypes = survey_responses::select('customerType', DB::raw('count(*) as total'))
->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]) // Apply the date range
->groupBy('customerType')
->get();

// Group by main office with a date range filter
$mainOffices = survey_responses::select('main_office', DB::raw('count(*) as total'))
->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]) // Apply the date range
->groupBy('main_office')
->get();

// Group by main office and sub office with a date range filter
$subOffices = survey_responses::select('main_office', 'office_transacted_with', DB::raw('count(*) as total'))
->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]) // Apply the date range
->groupBy('main_office', 'office_transacted_with')
->orderBy('main_office')
->get();
$services = survey_responses::select('main_office', 'service_availed', DB::raw('count(*) as total'))
    ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]) // Apply the date range
    ->groupBy('main_office', 'service_availed')
    ->get();


    
        // Count responses in current quarter
        $totalResponses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])->count();
    return response()->json([
        'ageSex' => $ageSex,
        'customerTypes' => $customerTypes,
        'mainOffices' => $mainOffices,
        'subOffices' => $subOffices,
        'services' => $services,
        'totalResponses' => $totalResponses,
        'quarter' => 'Q' . $quarter,
        'year' => $year
    ]);
}
}
