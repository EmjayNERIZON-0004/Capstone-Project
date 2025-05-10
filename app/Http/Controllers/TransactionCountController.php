<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainOffice;
use App\Models\SubOffice;
use App\Models\Service;
use App\Models\ServicesTransactionCount;
use App\Models\ServiceTransactionCount;

class TransactionCountController extends Controller
{
    public function index()
    {
        return view('OfficeView.OfficeTransactionCounts');
    }

    public function getTransactionStatus(String $main_id)
    {
        // Fetch the main office based on the main_id
        $mainOffice = MainOffice::where('office_id', $main_id)->first();
    
        // Handle case where main office is not found
        if (!$mainOffice) {
            return response()->json(['error' => 'Main office not found.'], 404);
        }
    
        $subOffices = SubOffice::where('main_office_id', $mainOffice->office_id)->get();
    
        $subOfficeData = [];
        $totalSubOffices = count($subOffices);
        $completedSubOffices = 0;
        
        foreach ($subOffices as $sub) {
            $services = Service::where('sub_office_id', $sub->id)->get();
            $serviceData = [];
            $allServicesSubmitted = true; // Flag to track if all services in this sub-office are submitted
        
            foreach ($services as $service) {
                $now = now();
                $currentQuarter = ceil($now->month / 3);
                $currentYear = $now->year;
        
                $transaction = ServiceTransactionCount::where('service_id', $service->id)
                    ->where('quarter', $currentQuarter)
                    ->where('year', $currentYear)
                    ->first();
        
                $hasTransaction = $transaction !== null;
                
                // If any service is not submitted, mark this sub-office as incomplete
                if (!$hasTransaction) {
                    $allServicesSubmitted = false;
                }
        
                $serviceData[] = [
                    'service_name' => $service->service_name,
                    'transaction_saved' => $hasTransaction,
                    'count' => $hasTransaction ? $transaction->transaction_count : null
                ];
            }
        
            // If all services are submitted, increment the completed sub-offices count
            if ($allServicesSubmitted && count($services) > 0) {
                $completedSubOffices++;
            }
        
            $subOfficeData[] = [
                'sub_office' => $sub->sub_office_name,
                'services' => $serviceData,
                'all_completed' => $allServicesSubmitted && count($services) > 0
            ];
        }
        
        return response()->json([
            'main_office' => $mainOffice->office_name,
            'sub_offices' => $subOfficeData,
            'total_sub_offices' => $totalSubOffices,
            'completed_sub_offices' => $completedSubOffices
        ]);
    }
}