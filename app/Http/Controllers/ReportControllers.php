<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainOffice;
use App\Models\SubOffice;
use App\Models\Service;
use App\Models\survey_responses;
use Carbon\Carbon;

class ReportControllers extends Controller


{
    public function responseRateOverall()
{
    $mainOffices = MainOffice::all();

    $grandSurveyTotal = 0;
    $grandTransactionTotal = 0;

    foreach ($mainOffices as $mainOffice) {
        $subOffices = SubOffice::where('main_office_id', $mainOffice->office_id)->get();

        foreach ($subOffices as $subOffice) {
            $services = Service::where('sub_office_id', $subOffice->id)
                ->whereIn('services_type', ['internal', 'external', 'both'])
                ->get();

            foreach ($services as $service) {
                $quarterStart = Carbon::now()->startOfQuarter();
                $quarterEnd = Carbon::now()->endOfQuarter();

                $surveyCount = survey_responses::where('service_availed', $service->service_name)
                    ->whereBetween('created_at', [$quarterStart, $quarterEnd])
                    ->count();

                    $transactionCount = \App\Models\ServiceTransactionCount::where('service_id', $service->id)
                    ->where('year', now()->year)
                    ->where('quarter', now()->quarter)
                    ->value('transaction_count') ?? 0;
                    
                $grandSurveyTotal += $surveyCount;
                $grandTransactionTotal += $transactionCount;
            }
        }
    }

    $grandRate = $grandTransactionTotal > 0 
        ? round(($grandSurveyTotal / $grandTransactionTotal) * 100, 2)
        : 0;

    return response()->json([
        'status' => 'success',
        'data' => [
            [
                'all_total_responses' => $grandSurveyTotal,
                'all_total_transactions' => $grandTransactionTotal,
                'all_total_rate' => $grandRate . '%',
            ]
        ]
    ]);
}

    public function responseRatePerService(String $type)
    {
        $mainOffices = MainOffice::all();
        $report = [];
    
        $grandSurveyTotal = 0;
        $grandTransactionTotal = 0;
    
        foreach ($mainOffices as $mainOffice) {
            $subOfficeData = [];
            $mainSurveyTotal = 0;
            $mainTransactionTotal = 0;
    
            $subOffices = SubOffice::where('main_office_id', $mainOffice->office_id)->get();
    
            foreach ($subOffices as $subOffice) {
                $services = Service::where('sub_office_id', $subOffice->id)
                    ->whereIn('services_type', [$type, 'both'])
                    ->get();
    
                if ($services->isEmpty()) continue;
    
                $serviceData = [];
    
                foreach ($services as $service) {
                    $quarterStart = Carbon::now()->startOfQuarter();
                    $quarterEnd = Carbon::now()->endOfQuarter();
    
                    $surveyCount = survey_responses::where('service_availed', $service->service_name)
                        ->whereBetween('created_at', [$quarterStart, $quarterEnd])
                        ->count();
    
                        $transactionCount = \App\Models\ServiceTransactionCount::where('service_id', $service->id)
                        ->where('year', now()->year)
                        ->where('quarter', now()->quarter)
                        ->value('transaction_count') ?? 0;

                    $rate = $transactionCount > 0 ? round(($surveyCount / $transactionCount) * 100, 2) : 0;
    
                    $mainSurveyTotal += $surveyCount;
                    $mainTransactionTotal += $transactionCount;
    
                    $serviceData[] = [
                        'service_name' => $service->service_name,
                        'survey_responses' => $surveyCount,
                        'transactions' => $transactionCount,
                        'rate' => $rate . '%',
                    ];
                }
    
                $subOfficeData[] = [
                    'sub_office' => $subOffice->sub_office_name,
                    'services' => $serviceData,
                ];
            }
    
            $overallRate = $mainTransactionTotal > 0 ? round(($mainSurveyTotal / $mainTransactionTotal) * 100, 2) : 0;
    
            // Add to grand total
            $grandSurveyTotal += $mainSurveyTotal;
            $grandTransactionTotal += $mainTransactionTotal;
    
            $report[] = [
                'main_office' => $mainOffice->office_name,
                'sub_offices' => $subOfficeData,
                'total_survey_responses' => $mainSurveyTotal,
                'total_transactions' => $mainTransactionTotal,
                'total_rate' => $overallRate . '%',
            ];
        }
    
        // Add grand total summary
        $grandRate = $grandTransactionTotal > 0 ? round(($grandSurveyTotal / $grandTransactionTotal) * 100, 2) : 0;
        $report[] = [
            'overall_total' => 'OVERALL', 
            'overall_total_survey_responses' => $grandSurveyTotal,
            'overall_total_transactions' => $grandTransactionTotal,
            'overall_total_rate' => $grandRate . '%',
        ];
    
        return response()->json([
            'status' => 'success',
            'data' => $report,
        ]);
    }
    
    

    public function score()
    {
        $internalServices = Service::whereIn('services_type', ['internal', 'both'])->pluck('service_name')->toArray();
        $externalServices = Service::whereIn('services_type', ['external', 'both'])->pluck('service_name')->toArray();
    
        $quarterStart = Carbon::now()->startOfQuarter();
        $quarterEnd = Carbon::now()->endOfQuarter();
    
        $internalResponses = survey_responses::whereIn('service_availed', $internalServices)
            ->whereBetween('created_at', [$quarterStart, $quarterEnd])
            ->get();
    
        $externalResponses = survey_responses::whereIn('service_availed', $externalServices)
            ->whereBetween('created_at', [$quarterStart, $quarterEnd])
            ->get();
    
        // Function to count responses
        function countResponses($responses) {
            $result = [];
    
            foreach (range(1, 8) as $i) {
                $sqdKey = "sqd{$i}";
                $result[$sqdKey] = [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                    'na' => 0,
                    'totalResponses' => 0,
                    'validResponses' => 0,
                    'percentageScore' => 0
                ];
    
                foreach ($responses as $response) {
                    $score = $response->$sqdKey;
                    if (in_array($score, [1, 2, 3, 4, 5])) {
                        $result[$sqdKey][$score]++;
                        $result[$sqdKey]['validResponses']++;
                    } else {
                        $result[$sqdKey]['na']++;
                    }
                    $result[$sqdKey]['totalResponses']++;
                }
    
                $valid = $result[$sqdKey]['validResponses'];
                $score4 = $result[$sqdKey][4];
                $score5 = $result[$sqdKey][5];
                $result[$sqdKey]['percentageScore'] = $valid > 0 ? round((($score4 + $score5) / $valid) * 100, 2) : 0;
            }
    
            return $result;
        }
    
        // Aggregate responses
        $internalCounts = countResponses($internalResponses);
        $externalCounts = countResponses($externalResponses);
    
        // Combine responses
        $combinedResponses = $internalResponses->merge($externalResponses);
        $combinedCounts = countResponses($combinedResponses);
    
        return response()->json([
            'internalCounts' => $internalCounts,
            'externalCounts' => $externalCounts,
            'combinedCounts' => $combinedCounts,
        ]);
    }
    


// private function calculateOverallCounts($counts)
// {
//     $overallCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

//     // Loop through each SQD (sqd1, sqd2, ..., sqd8)
//     foreach ($counts as $sqd => $scores) {
//         // Add the count of each score (1, 2, 3, 4, 5) to the overall count
//         foreach ($scores as $score => $count) {
//             $overallCounts[$score] += $count;
//         }
//     }

//     return $overallCounts;
// }
    }
