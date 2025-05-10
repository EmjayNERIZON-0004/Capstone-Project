<?php

namespace App\Http\Controllers;

use App\Models\MainOffice;
use App\Models\request as ModelsRequest;
use App\Models\survey_responses;
use App\Models\Notification
;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'main_office_id' => 'required',
            'request_type' => 'required|string|max:255',
        ]);

        // Save the request
        ModelsRequest::create([
            'main_office_id' => $request->main_office_id,
            'request_type' => $request->request_type,
            'status' => 'pending', // Default status
        ]);

        // Redirect back with success message
        return redirect()-> route('dashboard_with_score')->with('success', 'Your request has been submitted successfully. Wait the Admin for approval of your Request.');
    }
  public function checkStatus($office_id)
{
    $request = ModelsRequest::where('main_office_id', $office_id)
        ->where('request_type', 'View Complaints')
        ->latest()
        ->first();

    if (!$request) {
        return response()->json(['status' => 'none']);
    }

    return response()->json(['status' => $request->status]);
}

public function approvedComplaints()
{
    $officeId = session('office_name');
    $complaints = survey_responses::where('remarks_type', 'complaint')
                        ->where('main_office', $officeId)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('OfficeView.OfficeComplaints', compact('complaints'));
}
public function manageRequests()
{
    // Get pending requests for the table
    $requests = ModelsRequest::where('status', 'pending')->orderBy('created_at', 'desc')->get();
    
    // Get counts for dashboard cards
    $pendingCount = ModelsRequest::where('status', 'pending')->count();
    $approvedCount = ModelsRequest::where('status', 'approved')->count();
    $rejectedCount = ModelsRequest::where('status', 'rejected')->count();
    $totalCount = $pendingCount + $approvedCount + $rejectedCount;
    
    // Get requests by office
    $officeRequests = ModelsRequest::select('main_office_id')
        ->selectRaw('COUNT(*) as request_count')
        ->groupBy('main_office_id')
        ->orderByDesc('request_count')
        ->get();
    
    return view('AdminView.AdminRequestView', compact('requests', 'pendingCount', 'approvedCount', 'rejectedCount', 'totalCount', 'officeRequests'));
}

public function getDashboardData()
{
    // Get counts for dashboard cards
    $pendingCount = ModelsRequest::where('status', 'pending')->count();
    $approvedCount = ModelsRequest::where('status', 'approved')->count();
    $rejectedCount = ModelsRequest::where('status', 'rejected')->count();
    $totalCount = $pendingCount + $approvedCount + $rejectedCount;
    
    // Get requests by office
    $officeRequests = ModelsRequest::select('main_office_id')
        ->selectRaw('COUNT(*) as request_count')
        ->groupBy('main_office_id')
        ->orderByDesc('request_count')
        ->get();
    
    return response()->json([
        'pending' => $pendingCount,
        'approved' => $approvedCount,
        'rejected' => $rejectedCount,
        'total' => $totalCount,
        'officeRequests' => $officeRequests
    ]);
}






 
    public function getRecentActivity(): JsonResponse
    {
        $recentActivities = $this->getRecentActivitiesData();

        return response()->json([
            'success' => true,
            'activities' => $recentActivities
        ]);
    }

    /**
     * Helper method to get recent activity data
     */
    private function getRecentActivitiesData(): array
    {
        $recentActivities = ModelsRequest::whereNotNull('updated_at')
            ->whereIn('status', ['approved', 'rejected', 'pending'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get([
                'id', 
                'main_office_id', 
                'request_type', 
                'status', 
                'created_at', 
                'updated_at'
            ]);

        $activities = [];

        foreach ($recentActivities as $request) {
            $officeName = $this->getOfficeName($request->main_office_id);

            $iconClass = 'clock';
            $iconColor = 'warning';
            $action = 'New Request';

            if ($request->status === 'approved') {
                $iconClass = 'check-circle';  
                $iconColor = 'success';
                $action = 'Request Approved';
            } elseif ($request->status === 'rejected') {
                $iconClass = 'times-circle';
                $iconColor = 'danger';
                $action = 'Request Rejected';
            }

            $timeAgo = Carbon::parse($request->updated_at)->diffForHumans();

            $activities[] = [
                'id' => $request->id,
                'main_office_id' => $request->main_office_id,
                'office_name' => $officeName,
                'request_type' => $request->request_type,
                'status' => $request->status,
                'title' => "$officeName $action",
                'description' => ucfirst($request->request_type) . ' Request',
                'time_ago' => $timeAgo,
                'icon' => [
                    'class' => $iconClass,
                    'color' => $iconColor
                ]
            ];
        }

        return $activities;
    }

    /**
     * Helper method to get office name from main_office_id
     */
    private function getOfficeName($officeId): string
    {
        
          return MainOffice::where('office_id', $officeId)->value('office_name') ?? 'Unknown Department';

    } 



public function updateRequest(Request $request)
{
    $req = ModelsRequest::find($request->id);
    
        
    if ($req) {
        $req->status = $request->status;
        $req->save();
        
        // Create a notification
        Notification::create([
            'office_id' => $req->main_office_id,
            'title' => 'Request Notification',
            'message' => "Your request is " . $req->status, // Corrected string concatenation
            'is_read' => 'no',
        ]);
        return response()->json(['success' => true]);
    }
        return response()->json(['success' => false], 400);
}

public function requestHistory(Request $request)
{
    
    $status = $request->query('status');

      $requests = ModelsRequest::where('status', $status)
       
        ->orderBy('updated_at', 'desc')
        ->get(['id', 'main_office_id', 'request_type', 'created_at']);

    return response()->json(['requests' => $requests]);
}

}