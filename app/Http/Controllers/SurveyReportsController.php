<?
namespace App\Http\Controllers;
use App\Models\MainOffice;
use App\Models\SubOffice;
use App\Models\Service;

class SurveyReportsController extends Controller{
    public function responseRatePerService()
    {
        $mainOffices = MainOffice::all(); // Step 1: Get all main offices

        $report = [];
    
        foreach ($mainOffices as $mainOffice) {
            $subOffices = SubOffice::where('main_office_id', $mainOffice->office_id)->get();
    
            foreach ($subOffices as $subOffice) {
                $services = Service::where('sub_office_id', $subOffice->id)
                                   ->where('services_type', 'external')
                                   ->get();
    
                foreach ($services as $service) {
                    $surveyCount = $service->surveyResponses()->count();
                    $transactionCount = $service->transactions()->count();
    
                    $rate = $transactionCount > 0 ? round(($surveyCount / $transactionCount) * 100, 2) : 0;
    
                    $report[] = [
                        'main_office' => $mainOffice->name,
                        'sub_office' => $subOffice->name,
                        'service' => $service->name,
                        'survey_responses' => $surveyCount,
                        'transactions' => $transactionCount,
                        'rate' => $rate . '%',
                    ];
                }
            }
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $report,
        ]);
    }
}