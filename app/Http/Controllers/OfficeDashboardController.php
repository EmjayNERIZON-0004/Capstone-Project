<?php
namespace App\Http\Controllers;

use App\Models\MainOffice;
use App\Models\Service;
use App\Models\survey_responses;
use App\Models\SubOffice;
use Carbon\Carbon;
 use App\Models\NoTransaction;
use Illuminate\Http\Request;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\Auth; // If you are using authentication

class OfficeDashboardController extends Controller
{       



public function profile()
{
    $officeId = session('office_id');

    $office = MainOffice::where('office_id', $officeId)->first();

    if (!$office) {
        return redirect()->back()->with('error', 'Office not found.');
    }

    return view('OfficeView.OfficeProfile', compact('office'));
}

 public function upload(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

        $office = MainOffice::where('office_id', session('office_id'))->firstOrFail();

        // Delete old image if exists
        if ($office->image_path && file_exists(public_path('images/' . $office->image_path))) {
            unlink(public_path('images/' . $office->image_path));
        }

        // Save new image
        $file = $request->file('profile_image');
        $filename =   $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // Update DB
        $office->image_path = $filename;
        $office->save();

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }
    public function officeQRCodes()
    {
        $officeName = session('office_id'); // Get current office name from session
        // Get the full SubOffice objects
        $subOffices = SubOffice::where('main_office_id', $officeName)->get();  // Use get() instead of pluck()
        
        return view('OfficeView.OfficeQRGenerator', compact('subOffices'));
    }
    
  
    public function showDashboard()
    {
        $officeId = session('office_name'); // Get the office_name from session
        $now = Carbon::now();
    
        // Get start and end of the current quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
    
        // Fetch responses for the current quarter
        $responses = survey_responses::where('main_office', $officeId)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->get();
    
        return view('OfficeView.OfficeDashboard')->with('responses', $responses);
    }
    
    public function showGenerateTransactionNo()
    {
        return view('OfficeView.OfficeTransactionID'); // Ensure you have client_satisfaction.blade.php in resources/views
    }  
    
    public function showSurveys(int $quarter, int $year)
    {
        $officeId = session('office_id'); // Get the office_id from session
        $officeName = session('office_name');
    
        $now = Carbon::now();
    
           // Define start and end months based on the quarter
           $quarters = [
            1 => ['start' => 1,  'end' => 3],
            2 => ['start' => 4,  'end' => 6],
            3 => ['start' => 7,  'end' => 9],
            4 => ['start' => 10, 'end' => 12],
        ];
    
        if (!isset($quarters[$quarter])) {
            return response()->json(['error' => 'Invalid quarter.'], 400);
        }
    // Calculate the start and end date of the selected quarter
    $startOfQuarter = Carbon::create($year, $quarters[$quarter]['start'], 1)->startOfMonth();
    $endOfQuarter = Carbon::create($year, $quarters[$quarter]['end'], 1)->endOfMonth();

        // Fetch responses within the quarter
        $responses = survey_responses::where('main_office', $officeName)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->get();
    
        // Get sub-offices
        $subOffices = SubOffice::where('main_office_id', $officeId)->pluck('sub_office_name'); 
    
        // Count the number of responses
        $responses_count = $responses->count();
     

$startOfYear = Carbon::now()->startOfYear();
$now = Carbon::now();

$overall_responses_count = survey_responses::where('main_office', $officeName)
    ->whereBetween('created_at', [$startOfYear, $now])
    ->count();

        $years_cb = survey_responses::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderByDesc('year')
        ->pluck('year'); 

    $quarter_cb = survey_responses::selectRaw('QUARTER(created_at) as quarter')
        ->distinct()
        ->orderBy('quarter')
        ->pluck('quarter');

$currentYear = Carbon::now()->format('F j, Y');




 $currentYear = Carbon::now()->year;
    $quarterCounts = [];

    for ($q = 1; $q <= 4; $q++) {
        $start = Carbon::createFromDate($currentYear)->startOfYear()->addQuarters($q - 1)->startOfQuarter();
        $end = (clone $start)->endOfQuarter();

        $count = survey_responses::where('main_office', $officeName)
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $quarterCounts[] = $count;  // Only the count (you can use assoc arrays if you prefer)
    }

 
     





  return view('OfficeView.OfficeSurveyResponse', [
    'responses' => $responses,
    'years_cb' => $years_cb,
    'quarter_cb' => $quarter_cb,
    'subOffices' => $subOffices,
    'responses_count' => $responses_count,
    'currentYear' => $currentYear,
    'overall_responses_count' => $overall_responses_count,
    'quarterCounts' => $quarterCounts   
]);
    }
    
    public function getServices($subOfficeName) { 
        // Find the sub-office by name and get its ID
        $subOffice = SubOffice::where('sub_office_name', $subOfficeName)->first();
    
        if (!$subOffice) {
            return response()->json([], 404); // Return empty if not found
        }
    
        // Fetch services using the retrieved sub_office_id
        $services = Service::where('sub_office_id', $subOffice->id)
                    ->pluck('service_name')
                    ->toArray();
    
        return response()->json($services);
    }
    
    
   
    public function showReports()
    {
        return view('OfficeView.OfficeTransactionID'); // Ensure you have client_satisfaction.blade.php in resources/views
    }
    public function index()
    {
        // Assuming office is stored in session after login
        $officeName = session('office_name'); 
        $now = Carbon::now();

        // Get start and end of the current quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
    
// Fetch responses for the given office and current month
$responses = survey_responses::where('main_office', $officeName)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                           ->get(); 
                
$startOfYear = Carbon::now()->startOfYear();
$now = Carbon::now();

$responses_count = survey_responses::where('main_office', $officeName)
    ->whereBetween('created_at', [$startOfYear, $now])
    ->count();
        
                           // Use paginate(10) if needed
        foreach ($responses as $response) {
            $values = [
                $response->sqd1, $response->sqd2, $response->sqd3,
                $response->sqd4, $response->sqd5, $response->sqd6,
                $response->sqd7, $response->sqd8
            ];
        }
        $sqd_totals = array_fill(0, 8, 0);
        $sqd_counts = array_fill(0, 8, 0);
    
        foreach ($values as $index => $value) {
            if (is_numeric($value) && $value !== 'N/A') { // Ignore 'N/A' values
                $sqd_totals[$index] += $value;
                $sqd_counts[$index] += 1;
            }
        }
       
       
        return view('OfficeView.OfficeDashboard', compact('responses', 'officeName','sqd_totals', 'sqd_counts'));
    }


    public function getRankedSubOffices() {
        // Get the office name from the session
        $officeName = session('office_name');
        
        if (!$officeName) {
            return response()->json(['message' => 'Office name not found in session'], 404);
        }
    
        // Define the SQD columns (e.g., sqd1, sqd2, ... sqd8)
        $sqdColumns = [
            'sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'
        ];
    
        // Get current quarter and year
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentQuarter = $now->quarter;
        
        // Define start and end of the current quarter based on Carbon
        $startOfQuarter = $now->copy()->firstOfQuarter(); // Start of the current quarter
        $endOfQuarter = $now->copy()->lastOfQuarter(); // End of the current quarter
    
        // Fetch the responses for the current quarter (based on start and end of the quarter)
        $responses = survey_responses::where('main_office', $officeName)
          // Only consider responses with a valid sub-office
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]) // Filter by the current quarter
            ->get();
    
        // Initialize an array to store the scores per SQD and per sub-office
        $subOfficesScores = [];
    
        // Loop through each SQD column (sqd1, sqd2, ..., sqd8)
        foreach ($sqdColumns as $sqd) {
            // Initialize an array to store sub-office scores for this particular SQD
            $subOfficesScoresForSQD = [];
    
            // Loop through the responses and calculate counts for 5s, 4s, and N/A for each sub-office
            foreach ($responses as $response) {
                $subOffice = $response->office_transacted_with;
                $score = $response->$sqd; // Get the score for the current SQD
    
                // Initialize sub-office data if it doesn't exist
                if (!isset($subOfficesScoresForSQD[$subOffice])) {
                    $subOfficesScoresForSQD[$subOffice] = [
                        'total5s' => 0,
                        'total4s' => 0,
                        'totalNAs' => 0,
                        'totalResponses' => 0
                    ];
                }
    
                // Count the responses
                if ($score == 5) {
                    $subOfficesScoresForSQD[$subOffice]['total5s']++;
                } elseif ($score == 4) {
                    $subOfficesScoresForSQD[$subOffice]['total4s']++;
                } elseif ($score === 'N/A') {
                    $subOfficesScoresForSQD[$subOffice]['totalNAs']++;
                }
    
                // Increment the total response count for the sub-office
                $subOfficesScoresForSQD[$subOffice]['totalResponses']++;
            }
     
            // Calculate the average score for each sub-office for this SQD
            $averagesForSQD = [];
    
            foreach ($subOfficesScoresForSQD as $subOffice => $counts) {
                // Calculate valid responses (excluding N/A)
                $validResponses = $counts['totalResponses'] - $counts['totalNAs'];
    
                // Calculate the average score if there are valid responses
                if ($validResponses > 0) {
                    $averageScore = ($counts['total5s'] + $counts['total4s']) / $validResponses;
                } else {
                    $averageScore = 0; // No valid responses
                }
    
                $averagesForSQD[$subOffice] = [
                    'score' => $averageScore,
                    'totalResponses' => $counts['totalResponses'],
                    'total5s' => $counts['total5s'],
                    'total4s' => $counts['total4s'],
                    'totalNAs' => $counts['totalNAs']
                ];
            }
    
            // Sort the sub-offices for this SQD by score in descending order
            arsort($averagesForSQD);
    
            // Add the sorted results to the main array for all SQDs
            $subOfficesScores[$sqd] = $averagesForSQD;
        }
    
        // Return the results as JSON
        return response()->json([
            'office_name' => $officeName,
            'totalSurveyResponses' => $responses->count(),
            'rankedSubOfficesPerSQD' => $subOfficesScores
        ]);
    }
    
    

    public function computeOverallScore()
    {
        $officeName = session('office_name');
        $officeID = session('office_id');
    
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentQuarter = $now->quarter;
    
        // Define start and end of the quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();
        $endOfQuarter = $now->copy()->lastOfQuarter();
    
        // Get survey responses for the quarter
        $responses = survey_responses::where('main_office', $officeName)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->get();
    
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
    
        $scores = [];
        $total5s = 0;
        $total4s = 0;
        $totalNAs = 0;
        $totalValidResponses = 0;
    
        foreach ($sqdColumns as $key => $label) {
            $count5 = $responses->where($key, 5)->count();
            $count4 = $responses->where($key, 4)->count();
            $countNA = $responses->where($key, 'N/A')->count();
            $totalResponses = $responses->count();
            $validResponses = $totalResponses - $countNA;
    
            if ($countNA == $totalResponses) {
                $scores[$label] = 100;
            } else {
                $scores[$label] = $validResponses > 0 ? (($count5 + $count4) / $validResponses) * 100 : 0;
            }
    
            $total5s += $count5;
            $total4s += $count4;
            $totalNAs += $countNA;
            $totalValidResponses += $validResponses;
        }
    
        $overallScore = $totalValidResponses > 0 ? ($total5s + $total4s) / $totalValidResponses : 0;
    
        // Count related services
        $services_count = Service::where('main_office_id', $officeID)->count();
    
        // Count complaints for the current quarter
        $complaint_count = survey_responses::where('remarks_type', 'complaint')
            ->where('main_office', $officeName)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->count();
    
        // Days left in the quarter
        $currentDate = Carbon::now();
        $daysLeft = (int) $currentDate->diffInDays($endOfQuarter);
    
        // Still using month-based transaction checking unless table is updated
        $currentMonthYear = $currentDate->format('F Y');
        $transaction = NoTransaction::where('main_office_id', $officeID)
            ->where('month_year', $currentMonthYear)
            ->first();
    
        $threeDaysBeforeQuarterEnd = $endOfQuarter->copy()->subDays(3);
        $enableInput = !$transaction;
        $shouldHighlight = $currentDate->greaterThanOrEqualTo($threeDaysBeforeQuarterEnd) && !$transaction;
    
        return view('OfficeView.OfficeDashboard')->with([
            'sqd_scores' => json_encode($scores),
            'total_5s' => $total5s,
            'total_4s' => $total4s,
            'total_nas' => $totalNAs,
            'overall_score' => $overallScore,
            'responses' => $responses,
            'total_responses' => $responses->count(),
            'services_count' => $services_count,
            'complaint_count' => $complaint_count,
            'transaction' => $transaction,
            'daysLeft' => $daysLeft,
            'shouldHighlight' => $shouldHighlight,
            'enableInput' => $enableInput
        ]);
    }
    
    
    




    // public function section_score_quarterly(int $quarter,int $year)
    // {
    //     $officeName = session('office_name');
    //     $officeID = session('office_id');
    
    //     $now = Carbon::now();
    //     $quarters = [
    //         1 => ['start' => 1, 'end' => 3],
    //         2 => ['start' => 4, 'end' => 6],
    //         3 => ['start' => 7, 'end' => 9],
    //         4 => ['start' => 10, 'end' => 12],
    //     ];
    
    //     if (!isset($quarters[$quarter])) {
    //         return response()->json(['error' => 'Invalid quarter.'], 400);
    //     }
    
    //     $startOfQuarter = Carbon::create($year, $quarters[$quarter]['start'], 1)->startOfMonth();
    //     $endOfQuarter = Carbon::create($year, $quarters[$quarter]['end'], 1)->endOfMonth();
    
    //     // Get survey responses for the quarter
    //     $responses = survey_responses::where('main_office', $officeName)
    //         ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
    //         ->get();
    
    //     $sqdColumns = [
    //         'sqd1' => 'SQD1', 
    //         'sqd2' => 'SQD2', 
    //         'sqd3' => 'SQD3', 
    //         'sqd4' => 'SQD4', 
    //         'sqd5' => 'SQD5',
    //         'sqd6' => 'SQD6', 
    //         'sqd7' => 'SQD7', 
    //         'sqd8' => 'SQD8'
    //     ];
    
    //     $scores = [];
    //     $total5s = 0;
    //     $total4s = 0;
    //     $totalNAs = 0;
    //     $totalValidResponses = 0;
    
    //     foreach ($sqdColumns as $key => $label) {
    //         $count5 = $responses->where($key, 5)->count();
    //         $count4 = $responses->where($key, 4)->count();
    //         $countNA = $responses->where($key, 'N/A')->count();
    //         $totalResponses = $responses->count();
    //         $validResponses = $totalResponses - $countNA;
    
    //         if ($countNA == $totalResponses) {
    //             $scores[$label] = 100;
    //         } else {
    //             $scores[$label] = $validResponses > 0 ? (($count5 + $count4) / $validResponses) * 100 : 0;
    //         }
    
    //         $total5s += $count5;
    //         $total4s += $count4;
    //         $totalNAs += $countNA;
    //         $totalValidResponses += $validResponses;
    //     }
    
    //     $overallScore = $totalValidResponses > 0 ? ($total5s + $total4s) / $totalValidResponses : 0;
     
      
    //     return response()->json([
           
    //         'overall_score' => $overallScore,
       
    //     ]);
    // }

    public function section_score_quarterly(String $main_office_id)
{
    $office = MainOffice::where('office_id', $main_office_id)->first();

    if (!$office) {
        return response()->json([
            'success' => false,
            'message' => 'Main office not found.'
        ], 404);
    }

    $responses = survey_responses::where('main_office', $office->office_name)->get();


    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];

    // Group responses by year and quarter
    $grouped = $responses->groupBy(function ($item) {
        return $item->created_at->format('Y') . '-Q' . ceil($item->created_at->format('n') / 3);
    });

    $quarterly_scores = [];

    foreach ($grouped as $period => $items) {
        $total5s = 0;
        $total4s = 0;
        $totalNAs = 0;
        $totalValidResponses = 0;

        $totalSurveyResponses = $items->count();

        foreach ($sqdColumns as $column) {
            $count5 = $items->where($column, 5)->count();
            $count4 = $items->where($column, 4)->count();
            $countNA = $items->where($column, 'N/A')->count();

            $validResponses = $totalSurveyResponses - $countNA;

            $total5s += $count5;
            $total4s += $count4;
            $totalNAs += $countNA;
            $totalValidResponses += $validResponses;
        }

        $overallScore = $totalValidResponses > 0
            ? round(($total5s + $total4s) / $totalValidResponses, 4)
            : 0;

        [$year, $quarter] = explode('-Q', $period);

        $quarterly_scores[] = [
            'year' => (int) $year,
            'quarter' => 'Q' . $quarter,
            'totalSurveyResponses' => $totalSurveyResponses,
            'totalValidResponses' => $totalValidResponses,
            'total5s' => $total5s,
            'total4s' => $total4s,
            'overallScore' => $overallScore
        ];
    }

    return response()->json([
        'success' => true,
        'quarterly_scores' => $quarterly_scores
    ]);
}








    public function getRankedSectionOffices(String $MainOffice){
    

        $offices = SubOffice::where('main_office_id',$MainOffice)->get(); // Fetch all offices
        $totalOffices = $offices->count(); // Count total offices
        $now = Carbon::now(); // Get current date and time using Carbon
    
        // Get the start and end of the current quarter
        $startOfQuarter = $now->copy()->firstOfQuarter();  // Start of the current quarter
        $endOfQuarter = $now->copy()->lastOfQuarter();     // End of the current quarter
    
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
    
        $rankedOffices = $offices->map(function ($office) use ($sqdColumns) {
            $now = Carbon::now();
            $year = $now->year;
            $startOfQuarter = $now->copy()->firstOfQuarter();
            $endOfQuarter = $now->copy()->lastOfQuarter();
        
            $responses = survey_responses::where('office_transacted_with', $office->sub_office_name)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->whereYear('created_at',$year)
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
                'office_name' => $office->sub_office_name,
                'overall_score' => $overallScore,
                'total_responses' => $totalResponses,
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
}
