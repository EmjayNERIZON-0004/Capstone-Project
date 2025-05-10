<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MainOffice;
use App\Models\SubOffice;
use App\Models\Service;
use App\Models\survey_responses;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SurveyResponse; // Ensure the model is imported
use Illuminate\Support\Facades\File;

class AdminViewController extends Controller
{


    public function logs()
    {
        // Get the log file path
        $logFilePath = storage_path('logs/laravel.log');
    
        // Check if the log file exists
        if (File::exists($logFilePath)) {
            // Read the log file content
            $logs = File::get($logFilePath);
    
            // Filter out only INFO and WARNING logs
            $filteredLogs = $this->filterLogs($logs);
        } else {
            $filteredLogs = []; // Empty array if no log file is found
        }
    
        // Pass the logs to the view
        return view('AdminView.AdminLogs', compact('filteredLogs'));
    }
    
    private function filterLogs($logs)
    {
        $filteredLogs = [];
        $logLines = explode("\n", $logs); // Split the logs into lines
    
        foreach ($logLines as $line) {
            if (strpos($line, 'INFO') !== false || strpos($line, 'WARNING') !== false) {
                $filteredLogs[] = $line; // Keep only INFO and WARNING lines
            }
        }
    
        return array_reverse($filteredLogs); // Return the filtered logs as an array, reversed
    }
    
 /**
 * Get historical positive sentiment data grouped by month
 * 
 * @return \Illuminate\Http\JsonResponse
 */
public function getHistoricalPositive()
{
    try {
        // Get data from the past 6 months
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth(); // Include current month
        
        // Fetch positive feedback counts grouped by month
        $positiveFeedbackCounts = DB::table('survey_responses')  // Use your actual table name
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', $sixMonthsAgo)
            ->where(function($query) {
                // Adjust this condition based on how you determine positive sentiment
                // Option 1: If you have a sentiment column
                $query->where('sentiment', 'positive');
                
                // Option 2: If you determine sentiment based on rating
                // $query->where('rating', '>', 3);
            })
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        // Create an array with all 6 months (including current month)
        $result = $this->generateMonthlyDataArray(6, $positiveFeedbackCounts);
        
        return response()->json($result);
    } catch (\Exception $e) {
        Log::error('Error fetching historical positive feedback: ' . $e->getMessage());
        return response()->json([], 500);
    }
}

/**
 * Get historical negative sentiment data grouped by month
 * 
 * @return \Illuminate\Http\JsonResponse
 */
public function getHistoricalNegative()
{
    try {
        // Get data from the past 6 months
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth(); // Include current month
        
        // Fetch negative feedback counts grouped by month
        $negativeFeedbackCounts = DB::table('survey_responses')  // Use your actual table name
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', $sixMonthsAgo)
            ->where(function($query) {
                // Adjust this condition based on how you determine negative sentiment
                // Option 1: If you have a sentiment column
                $query->where('sentiment', 'negative');
                
                // Option 2: If you determine sentiment based on rating
                // $query->where('rating', '<=', 3);
            })
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        // Create an array with all 6 months (including current month)
        $result = $this->generateMonthlyDataArray(6, $negativeFeedbackCounts);
        
        return response()->json($result);
    } catch (\Exception $e) {
        Log::error('Error fetching historical negative feedback: ' . $e->getMessage());
        return response()->json([], 500);
    }
}

/**
 * Helper function to generate a complete monthly data array
 * 
 * @param int $numberOfMonths
 * @param Collection $dbData
 * @return array
 */
private function generateMonthlyDataArray($numberOfMonths, $dbData)
{
    $result = [];
    $now = Carbon::now();
    
    // Generate entries for each month
    for ($i = $numberOfMonths - 1; $i >= 0; $i--) {
        $month = $now->copy()->subMonths($i);
        $monthNumber = $month->month;
        $year = $month->year;
        $monthLabel = $month->format('M'); // Short month name (Jan, Feb, etc.)
        
        // Find if we have data for this month
        $monthData = $dbData->first(function ($item) use ($monthNumber, $year) {
            return $item->month == $monthNumber && $item->year == $year;
        });
        
        // Add to result array
        $result[] = [
            'month' => $monthNumber,
            'year' => $year,
            'label' => $monthLabel,
            'count' => $monthData ? $monthData->count : 0
        ];
    }
    
    return $result;
}

 




















    public function getServicePerformanceChart()
    {
        // Get the current date and time using Carbon
        $now = Carbon::now();
        $currentYear = Carbon::now()->year;
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();


    
        // Define the SQD columns
        $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
    
        $results = [];
    
        // Fetch all survey responses in the current quarter and year
        $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->whereYear('created_at', $currentYear)
            
        ->get();
    
        // Loop through each SQD column to calculate its score
        foreach ($sqdColumns as $sqd) {
            // Count the number of responses with each score (5, 4, and N/A) for this SQD column
            $total5s = $responses->where($sqd, 5)->count();
            $total4s = $responses->where($sqd, 4)->count();
            $totalNAs = $responses->where($sqd, 'N/A')->count();
            
            // Calculate total responses for this SQD
            $totalSQDResponses = $responses->count();
    
            // Calculate valid responses for this SQD (excluding 'N/A' responses)
            $validResponses = $totalSQDResponses - $totalNAs;
    
            // Calculate the score for this SQD
            $score = $validResponses > 0 ? ($total5s + $total4s) / $validResponses : 0;
    
            // Store the result for this SQD
            $results[] = [
                'sqd' => $sqd,
                'score' => round($score, 4)  // Round to 4 decimal places for precision
            ];
        }
    
        // Return the results as JSON
        return response()->json([
            'data' => $results
        ]);
    }
    
    public function showSentimentData(String $sentiment)
    {
        $now = Carbon::now(); // Get current date and time using Carbon
        $currentYear = Carbon::now()->year;  
          $startOfQuarter = Carbon::create($currentYear, 1, 1)->startOfDay();
        $endOfQuarter = Carbon::create($currentYear, 3, 31)->endOfDay();
     // Get the start and end of the current quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
        // Fetch negative sentiments within the current quarter
         $negativeSentiments = survey_responses::where('sentiment', $sentiment)
        ->whereYear('created_at', $currentYear)   
        ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            
            ->get();
    
        // Return the negative sentiments as JSON
        return response()->json($negativeSentiments);
    }
   
  public function OfficeManagement(){
    return view ('AdminView.AdminDashboardOfficeManagement');
  }
    // Store client information after transaction verification
    public function reports(){
        
        return view ('AdminView.AdminDashboardReportManagement');
    }
 
public function surveys(Request $request)
{
    // Get quarter and year from the request, or use current ones by default
    $selectedQuarter = $request->input('quarter', Carbon::now()->quarter);
    $selectedYear = $request->input('year', Carbon::now()->year);

    // Calculate start and end dates based on quarter
    $startMonth = ($selectedQuarter - 1) * 3 + 1;
    $startDate = Carbon::create($selectedYear, $startMonth, 1)->startOfMonth();
    $endDate = $startDate->copy()->addMonths(2)->endOfMonth();

    // Fetch responses for the selected quarter and year
    $responses = survey_responses::whereBetween('created_at', [$startDate, $endDate])->get()    ;
    $total_responses = $responses->count();

                                   $total_responses = $responses->count();
      $mainOffice = MainOffice::all();
      $subOffice = SubOffice::all();
      $service = Service::all();
      return view('AdminView.AdminSurveyList', compact(
        'responses', 
        'mainOffice', 
        'service',
        'subOffice', 
        'total_responses',
        'selectedQuarter',
        'selectedYear'
    ));  

}
    public function dashboard() { 
        $now = Carbon::now(); // Get current date and time using Carbon
        $currentYear = Carbon::now()->year;  
        // Get the start and end of the current quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
    
        // Get the office name (you can customize this part based on your logic)
       
        // Get survey responses for the current quarter using whereBetween()
        $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->whereYear('created_at', $currentYear)    
        ->get();
    
        // Count the total responses, positive and negative sentiments
        $total_responses = $responses->count();
        $positiveCount = $responses->where('sentiment', 'positive')->count();
        $negativeCount = $responses->where('sentiment', 'negative')->count();
    
        // Return the view with the data
        return view('AdminView.AdminDashboard', compact('total_responses', 'positiveCount', 'negativeCount'));
    }
    

    public function index()
    { 
        $currentYear = Carbon::now()->year;
        $now = Carbon::now(); // Get current date and time using Carbon
    
        // Get the start and end of the current quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
    
        // Fetch responses for the current month
        $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                                   ->whereYear('created_at', $currentYear)->get(); ; 

                                   $total_responses = $responses->count();
      $mainOffice = MainOffice::all();
        return view('AdminView.AdminSurveyList', compact('responses','mainOffice','total_responses'));
    }






   





    












    
//     public function goBackToSubOffice(Request $request)
//     {
        
//         // Retrieve the selected subOffice ID from the form data
//         $subOfficeId = $request->input('sub_office');
//        // Fetch the selected sub-office details
//         $sub_offices = SubOffice::where('id', $subOfficeId)->first();
        
//         // Find the main office using the sub-office's main_office_id
//         $selected_office = MainOffice::where('office_id', $sub_offices->main_office_id)->first();

//         $sub_offices = SubOffice::where('main_office_id', $selected_office->office_id)->get();
//          // Pass data to the view
//         return view('surveyPage.selectSubOffice', compact('sub_offices', 'selected_office','subOfficeId'));
//     }
    

//     public function goBackToMainOffice(Request $request)
// {
    
//     $main_office_id = $request->input('main_office_id');

//     // Retrieve the main office data
//     $main_office = MainOffice::where('office_id', $main_office_id)->first();
   

//     // Fetch all main offices again for the dropdown list
//     $mainOffices = MainOffice::all();

//     return view('surveyPage.ClientSurveyP2', compact('main_office', 'mainOffices'));
// }







// public function goBackToServices(Request $request)
// {
//     // Retrieve the selected service using services_id from the GET request
//     $selected_service = Service::find($request->input('services_id'));

   

//     // Retrieve the sub-office using the sub_office_id from the service
//     $selected_sub_office = SubOffice::find($selected_service->sub_office_id);

 
//     // Fetch services that belong to the same main_office and sub_office
//     $services = Service::where('main_office_id', $selected_sub_office->main_office_id)
//                         ->where('sub_office_id', $selected_sub_office->id)
//                         ->get();

//     return view('surveyPage.ClientSurveyP3', compact('selected_sub_office', 'services'));
// }

public function Admin_OfficeRemarks(int $quarter, int $year)
{
  
    $quarters = [
        1 => ['start' => 1, 'end' => 3],
        2 => ['start' => 4, 'end' => 6],
        3 => ['start' => 7, 'end' => 9],
        4 => ['start' => 10, 'end' => 12],
    ];

    if (!isset($quarters[$quarter])) {
        return response()->json(['error' => 'Invalid quarter.'], 400);
    }

    $startOfQuarter = Carbon::create($year, $quarters[$quarter]['start'], 1)->startOfMonth();
    $endOfQuarter = Carbon::create($year, $quarters[$quarter]['end'], 1)->endOfMonth();

    // Get distinct main_offices within the date range
    $mainOffices = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->whereYear('created_at', $year)
        ->distinct()
        ->pluck('main_office');


       
    $data = [];

    foreach ($mainOffices as $mainOffice) {
        $responses = survey_responses::where('main_office', $mainOffice)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->whereYear('created_at', $year);

        $totalResponses = $responses->count();

        $complaints = (clone $responses)->where('remarks_type', 'complaint')->count();
        $feedbacks = (clone $responses)->where('remarks_type', 'feedback')->count();
        $recommendations = (clone $responses)->where('remarks_type', 'recommendation')->count();

        // Get sub-offices (office_transacted_with)
        $subOffices = (clone $responses)
            ->select('office_transacted_with')
            ->whereNotNull('office_transacted_with')
            ->distinct()
            ->pluck('office_transacted_with');

        $subOfficeData = [];

        foreach ($subOffices as $subOffice) {
            $services = survey_responses::where('main_office', $mainOffice)
                ->where('office_transacted_with', $subOffice)
                ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                ->whereYear('created_at', $year)
                ->select('service_availed', DB::raw('count(*) as responses'))
                ->groupBy('service_availed')
                ->get();

            $servicesList = [];

            foreach ($services as $service) {
                if ($service->service_availed) {
                    $servicesList[] = [
                        'service_name' => $service->service_availed,
                        'responses' => $service->responses
                    ];
                }
            }

            if (!empty($servicesList)) {
                $subOfficeData[] = [
                    'sub_office_name' => $subOffice,
                    'services' => $servicesList
                ];
            }
        }

        // Services not associated with a sub-office
        $definedServices = $subOfficeData
            ? collect($subOfficeData)->pluck('services')->flatten()->pluck('service_name')->toArray()
            : [];

        $otherServices = (clone $responses)
            ->where(function ($query) {
                $query->whereNull('office_transacted_with')->orWhere('office_transacted_with', '');
            })
            ->whereNotIn('service_availed', $definedServices)
            ->select('service_availed', DB::raw('count(*) as responses'))
            ->groupBy('service_availed')
            ->get();

            $mainOfficeRecord = MainOffice::where('office_name', $mainOffice)->first();
            $officeId = $mainOfficeRecord?->office_id;
            
            $officeData = [
                'office_id' => $officeId,
            'office_name' => $mainOffice,
            'complaints' => $complaints,
            'feedbacks' => $feedbacks,
            'recommendations' => $recommendations,
            'total_responses' => $totalResponses,
            'sub_offices' => $subOfficeData,
        ];

        if ($otherServices->count() > 0) {
            $officeData['other_requests'] = [];

            foreach ($otherServices as $srv) {
                $officeData['other_requests'][] = [
                    'service_name' => $srv->service_availed,
                    'responses' => $srv->responses
                ];
            }
        }

        if (!empty($subOfficeData) || !empty($officeData['other_requests'])) {
            $data[] = $officeData;
        }
    }

    return response()->json($data);
}




public function getRankedOffices(int $quarter, int $year){
    

    $offices = MainOffice::all(); // Fetch all offices
    $totalOffices = $offices->count(); // Count total offices
    $now = Carbon::now(); // Get current date and time using Carbon
 
    // Map quarters to start and end months
    $quarters = [
        1 => ['start' => 1,  'end' => 3],
        2 => ['start' => 4,  'end' => 6],
        3 => ['start' => 7,  'end' => 9],
        4 => ['start' => 10, 'end' => 12],
    ];

    if (!isset($quarters[$quarter])) {
        return response()->json(['error' => 'Invalid quarter.'], 400);
    }

    // Define the date range based on selected quarter/year
    $startOfQuarter = Carbon::create($year, $quarters[$quarter]['start'], 1)->startOfMonth();
    $endOfQuarter = Carbon::create($year, $quarters[$quarter]['end'], 1)->endOfMonth();

    
 // Get the total survey responses for the current quarter
    $totalSurveyResponses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
       
    ->count();

    $sqdColumns = [
        'sqd1' => 'SQD1',
        'sqd2' => 'SQD2',
        'sqd3' => 'SQD3',
        'sqd4' => 'SQD4',
        'sqd5' => 'SQD5',
        'sqd6' => 'SQD6',
        'sqd7' => 'SQD7',
        'sqd8' => 'SQD8'
    ];

    $rankedOffices = $offices->map(function ($office) use ($sqdColumns, $year, $quarter, $quarters) {

    
    
    $startOfQuarter = Carbon::create($year, $quarters[$quarter]['start'], 1)->startOfMonth();
    $endOfQuarter = Carbon::create($year, $quarters[$quarter]['end'], 1)->endOfMonth();
 
        $responses = survey_responses::where('main_office', $office->office_name)
        ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->get();
    
        $total5s = $total4s = $totalNAs = $totalValidResponses = 0;

        foreach ($sqdColumns as $key => $label) {
            $count5 = $responses->where($key, 5)->count();
            $count4 = $responses->where($key, 4)->count();
            $countNA = $responses->where($key, 'N/A')->count();
            $totalResponses = $responses->count();
            $validResponses = $totalResponses - $countNA;

            $total5s += $count5;
            $total4s += $count4;
            $totalNAs += $countNA;
            $totalValidResponses += $validResponses;
        }

        // Calculate overall score
        $overallScore = ($totalValidResponses > 0) ? ($total5s + $total4s) / $totalValidResponses : 0;

        // Add computed score to the office object
        $office->overall_score = $overallScore;









        
        return [
            'office_name' => $office->office_name,
            'overall_score' => $overallScore,
            'total_responses' => $totalResponses,
            'complaints' => $responses->where('type', 'complaint')->count(),
            'feedbacks' => $responses->where('type', 'feedback')->count(),
            'recommendations' => $responses->where('type', 'recommendation')->count(),
        ];
    })
    ->sortByDesc('overall_score') // Sort in descending order (highest score first)
    ->values(); // Reset array index

    return response()->json([
        'totalOffices' => $totalOffices,
        'totalSurveyResponses' => $totalSurveyResponses,
        'rankedOffices' => $rankedOffices
    ]);
    
}
public function getOverallSurveyScore()
{ 
    $sqdColumns = [
        'sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'
    ];
    $now = Carbon::now();
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();
      $currentYear = Carbon::now()->year;   // Example: 2025
    
    $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                           ->whereYear('created_at', $currentYear) ->get();;

    $total5s = $total4s = $totalNAs = $totalValidResponses = 0;

    foreach ($sqdColumns as $column) {
        $count5 = $responses->where($column, 5)->count();
        $count4 = $responses->where($column, 4)->count();
        $countNA = $responses->where($column, 'N/A')->count();
        $totalResponses = $responses->count();
        $validResponses = $totalResponses - $countNA;

        $total5s += $count5;
        $total4s += $count4;
        $totalNAs += $countNA;
        $totalValidResponses += $validResponses;
    }

    // Calculate overall score
    $overallScore = ($totalValidResponses > 0) ? ($total5s + $total4s) / $totalValidResponses : 0;

    return response()->json([
        'totalSurveyResponses' => $responses->count(),
        'totalValidResponses' => $totalValidResponses,
        'overallScore' => $overallScore,
        'total5s' => $total5s,
        'total4s' => $total4s,
        
    ]);
    }
    public function getOverallScoreByMainOffice()
    {
        $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
        $startOfQuarter = Carbon::now()->firstOfQuarter();
        $endOfQuarter = Carbon::now()->lastOfQuarter();
        $currentYear = Carbon::now()->year;
         
        $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->whereYear('created_at', $currentYear)
        ->get();
    
        $grouped = $responses->groupBy('main_office');
        $result = [];
    
        foreach ($grouped as $office => $group) {
            $total5s = $total4s = $totalNAs = $totalValidResponses = 0;
    
            foreach ($sqdColumns as $column) {
                $count5 = $group->where($column, 5)->count();
                $count4 = $group->where($column, 4)->count();
                $countNA = $group->where($column, 'N/A')->count();
                $validResponses = $group->count() - $countNA;
    
                $total5s += $count5;
                $total4s += $count4;
                $totalValidResponses += $validResponses;
            }
    
            $score = ($totalValidResponses > 0) ? ($total5s + $total4s) / $totalValidResponses : 0;
    
            $grade = match (true) {
                $score < 0.60 => 'Poor',
                $score < 0.80 => 'Fair',
                $score < 0.95 => 'Satisfactory',
                default => 'Outstanding'
            };
    
            $result[] = [
                'main_office' => $office,
                'overallScore' => $score,
                'grade' => $grade,
            ];
        }
    
        return response()->json(['success' => true, 'data' => $result]);
    }
    
    public function getYearlySurveyScores()
{
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];

    $responses = survey_responses::select('created_at', ...$sqdColumns)->get();

    $groupedByYear = $responses->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->created_at)->format('Y');
    });

    $yearlyScores = [];

    foreach ($groupedByYear as $year => $group) {
        $total5s = $total4s = $totalNAs = $totalValid = 0;

        foreach ($sqdColumns as $column) {
            $count5 = $group->where($column, 5)->count();
            $count4 = $group->where($column, 4)->count();
            $countNA = $group->where($column, 'N/A')->count();

            $total5s += $count5;
            $total4s += $count4;
            $totalNAs += $countNA;
        }

        $totalResponses = $group->count() * count($sqdColumns);
        $validResponses = $totalResponses - $totalNAs;

        $overallScore = $validResponses > 0 ? ($total5s + $total4s) / $validResponses : 0;

        $yearlyScores[] = [
            'year' => $year,
            'overallScore' => round($overallScore, 3),
        ];
    }

    return response()->json([
        'success' => true,
        'yearly_scores' => collect($yearlyScores)->sortBy('year')->values()->all(),
    ]);
}
public function getQuarterlySurveyScores()
{
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];

    // Get distinct years in the survey responses
    $years = survey_responses::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->pluck('year')
        ->toArray();

    $result = [];

    foreach ($years as $year) {
        $quarters = [
            'Q1' => ['start' => Carbon::create($year, 1, 1), 'end' => Carbon::create($year, 3, 31)],
            'Q2' => ['start' => Carbon::create($year, 4, 1), 'end' => Carbon::create($year, 6, 30)],
            'Q3' => ['start' => Carbon::create($year, 7, 1), 'end' => Carbon::create($year, 9, 30)],
            'Q4' => ['start' => Carbon::create($year, 10, 1), 'end' => Carbon::create($year, 12, 31)],
        ];

        foreach ($quarters as $quarter => $range) {
            // Fetch responses for the current year and quarter
            $responses = survey_responses::whereBetween('created_at', [$range['start'], $range['end']])->get();

            if ($responses->isEmpty()) {
                continue; // Skip quarters with no responses
            }

            $total5s = $total4s = $totalNAs = $totalValidResponses = 0;

            foreach ($sqdColumns as $column) {
                $count5 = $responses->where($column, 5)->count();
                $count4 = $responses->where($column, 4)->count();
                $countNA = $responses->where($column, 'N/A')->count();
                $totalResponses = $responses->count();
                $validResponses = $totalResponses - $countNA;

                $total5s += $count5;
                $total4s += $count4;
                $totalNAs += $countNA;
                $totalValidResponses += $validResponses;
            }

            $overallScore = $totalValidResponses > 0 ? ($total5s + $total4s) / $totalValidResponses : 0;

            // Append the result for this year and quarter
            $result[] = [
                'year' => $year,
                'quarter' => $quarter,
                'totalSurveyResponses' => $responses->count(),
                'totalValidResponses' => $totalValidResponses,
                'total5s' => $total5s,
                'total4s' => $total4s,
                'overallScore' => round($overallScore, 4),
            ];
        }
    }

    return response()->json([
        'success' => true,
        'quarterly_scores' => $result,
    ]);
}

public function getTopOfficesPerSQD()
{
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
    $offices = MainOffice::all();

    $topOffices = [];

    foreach ($sqdColumns as $sqd) {
        $currentYear = Carbon::now()->year;
        $now = Carbon::now();
     
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
    
        $officeScores = [];

        foreach ($offices as $office) {
            $responses = survey_responses::where('main_office', $office->office_name)
                ->whereYear('created_at', $currentYear)
                ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                ->get();

            $count5 = $responses->where($sqd, 5)->count();
            $count4 = $responses->where($sqd, 4)->count();
            $countNA = $responses->where($sqd, 'N/A')->count();
            $totalResponses = $responses->count();
            $validResponses = $totalResponses - $countNA;

            // Calculate SQD Score
            $sqdScore = ($validResponses > 0) ? ($count5 + $count4) / $validResponses : 0;

            // Store the score for each office
            $officeScores[] = [
                'office_name' => $office->office_name,
                'score' => $sqdScore
            ];
        }

        // Sort offices by score in descending order
        usort($officeScores, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Store the sorted list of all offices with their scores for the current SQD
        $topOffices[$sqd] = $officeScores;
    }

    return response()->json([
        'topOfficesPerSQD' => $topOffices
    ]);
}





public function getTopSectionPerSQD()
{
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
    $offices = SubOffice::with('mainOffice')->get();

    $allOfficesPerSQD = [];

    $now = Carbon::now();
    $currentYear = Carbon::now()->year;  
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    foreach ($sqdColumns as $sqd) {
        $allOfficesPerSQD[$sqd] = [];

        foreach ($offices as $office) {
            $responses = survey_responses::where('office_transacted_with', $office->sub_office_name)
            ->whereYear('created_at', $currentYear)  
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                ->get();

            if ($responses->isEmpty()) {
                continue; // Skip if no responses
            }

            $count5 = $responses->where($sqd, 5)->count();
            $count4 = $responses->where($sqd, 4)->count();
            $countNA = $responses->where($sqd, 'N/A')->count();
            $totalResponses = $responses->count();
            $validResponses = $totalResponses - $countNA;

            // Only include if there are valid responses (excluding N/A)
            if ($validResponses > 0) {
                $sqdScore = ($count5 + $count4) / $validResponses;

                $allOfficesPerSQD[$sqd][] = [
                      'sub_office_name' => $office->sub_office_name,
                    'score' => $sqdScore
                ];
            }
        }

        // Optional: Sort offices per SQD by score (highest first)
        usort($allOfficesPerSQD[$sqd], fn($a, $b) => $b['score'] <=> $a['score']);
    }

    return response()->json([
        'allOfficesPerSQD' => $allOfficesPerSQD
    ]);
}


public function getTopServicePerSQD()
{
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
    $offices = Service::all();

    $allOfficesPerSQD = [];

    $now = Carbon::now();
    $currentYear = Carbon::now()->year;  
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    foreach ($sqdColumns as $sqd) {
        $allOfficesPerSQD[$sqd] = [];

        foreach ($offices as $office) {
            $responses = survey_responses::where('service_availed', $office->service_name)
            ->whereYear('created_at', $currentYear)    
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                ->get();

            if ($responses->isEmpty()) {
                continue; // Skip if no responses
            }

            $count5 = $responses->where($sqd, 5)->count();
            $count4 = $responses->where($sqd, 4)->count();
            $countNA = $responses->where($sqd, 'N/A')->count();
            $totalResponses = $responses->count();
            $validResponses = $totalResponses - $countNA;

            // Only include if there are valid responses (excluding N/A)
            if ($validResponses > 0) {
                $sqdScore = ($count5 + $count4) / $validResponses;

                $allOfficesPerSQD[$sqd][] = [
                      'service_name' => $office->service_name,
                    'score' => $sqdScore
                ];
            }
        }

        // Optional: Sort offices per SQD by score (highest first)
        usort($allOfficesPerSQD[$sqd], fn($a, $b) => $b['score'] <=> $a['score']);
    }

    return response()->json([
        'allOfficesPerSQD' => $allOfficesPerSQD
    ]);
}

}
