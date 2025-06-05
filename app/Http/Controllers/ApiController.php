    <?php

    namespace App\Http\Controllers;

    use App\Models\MainOffice;
    use App\Models\Service;
    use App\Models\SubOffice;
    use App\Models\survey_responses;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    class ApiController extends Controller
    {
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
