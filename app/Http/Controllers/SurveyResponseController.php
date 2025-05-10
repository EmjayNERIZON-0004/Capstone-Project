<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\NoTransaction;
use App\Models\MainOffice;
use App\Models\Service;
use App\Models\survey_responses;
use Illuminate\Http\Request; 
 
class SurveyResponseController extends Controller
{
    // Display the list of survey responses
    

  
    public function computeOverallScore1()
    {
        // Get office name from session
        $officeName = session('office_name');
    
        // Fetch responses only for this office
        $responses = survey_responses::where('main_office', $officeName)->get();
    
        // Initialize counters
        $stronglyAgreeCount = 0;
        $agreeCount = 0;
        $naCount = 0;
        $totalRespondents = $responses->count(); // Count total respondents (rows)
    
        // Question columns
        $questionColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
    
        // Loop through responses
        foreach ($responses as $response) {
            foreach ($questionColumns as $column) {
                $value = strtoupper(trim($response->$column));
    
                if ($value === '5') {
                    $stronglyAgreeCount++;
                } elseif ($value === '4') {
                    $agreeCount++;
                } elseif ($value === 'N/A') {
                    $naCount++; // Count every N/A cell
                }
            }
        }
    
        // Apply formula: (Total 5s + Total 4s) / (Total Respondents - Total N/A Answers)
        $validRespondents = $totalRespondents - $naCount;
        $overallScore = $validRespondents > 0 ? ($stronglyAgreeCount + $agreeCount) / $validRespondents : 0;
    
        // Return JSON response
        return response()->json([
            'overall_score' => round($overallScore, 2),
            'strongly_agree' => $stronglyAgreeCount,
            'agree' => $agreeCount,
            'total_na' => $naCount,
            'total_respondents' => $totalRespondents, // Now it correctly counts rows
        ]);
    }


    public function computeOverallScore2()
    {
        $officeName = session('office_name');
        $currentMonth = Carbon::now()->month;
$currentYear = Carbon::now()->year;
        // Fetch all survey responses for the current office
     
        $responses = survey_responses::where('main_office', $officeName)
        ->whereMonth('created_at', $currentMonth)  // Filter by current month
        ->whereYear('created_at', $currentYear)    // Filter by current year
        ->get();
    
        // Define the SQD columns
        $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];
    
        // Initialize scores array
        $scores = [];
        $totalScoreSum = 0; // To store the sum of all SQD scores
        $validSQDCount = 0; // To count SQDs that have valid respondents
    
        // Count total respondents (each row is a respondent)
        $totalRespondents = $responses->count();
    
        // Loop through each SQD column to compute its score
        foreach ($sqdColumns as $sqd) {
            // Count Strongly Agree (5) and Agree (4) per column
            $stronglyAgreeCount = $responses->where($sqd, '5')->count();
            $agreeCount = $responses->where($sqd, '4')->count();
            
            // Count N/A responses per column
            $naCount = $responses->where($sqd, 'N/A')->count();
            
            // Compute valid respondents for this SQD (Total Respondents - N/A Count)
            $validRespondents = $totalRespondents - $naCount;
    
            // Compute SQD Score (avoid division by zero)
            $scores[$sqd] = $validRespondents > 0 
                ? ($stronglyAgreeCount + $agreeCount) / $validRespondents 
                : 0;
    
            // Add to total score sum for average calculation
            if ($validRespondents > 0) {
                $totalScoreSum += $scores[$sqd];
                $validSQDCount++; // Count valid SQDs
            }
        }
    
        // Compute overall average score (sum of SQD scores / number of valid SQDs)
       $totalScore = $totalScoreSum; // Simply store the total sum without averaging

        // Return response with SQD scores and overall average
        return response()->json([
            'sqd_scores' => $scores,
            'average_score' => round($totalScore, 2) // Rounded to 2 decimal places
        ]);
    }
    
    
    
   
    


}
