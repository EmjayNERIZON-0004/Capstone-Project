<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; // Assuming Feedback is your model
use App\Models\survey_responses;
use App\Models\Notification;

class FeedbackController extends Controller
{
    public function viewFeedbacks($office_name)
    {
        // Retrieve feedbacks where office_name matches
        $feedbacks = survey_responses::where('main_office', $office_name)
        ->where('remarks_type', 'feedback')
        ->get();
    
        // Pass feedbacks to the view
        return view('OfficeView.OfficeFeedback', compact('feedbacks', 'office_name'));
    }
    
    public function notifyOffice($office_id, $title, $message)
{
    Notification::create([
        'office_id' => $office_id,
        'title' => $title,
        'message' => $message,
        'is_read' => 0
    ]);  

    return response()->json(['success' => 'Notification sent successfully']);
}
public function index()
{
    $office_id = session('office_id');
    $notifications = Notification::where('office_id', $office_id)
        ->orderBy('created_at', 'desc')
        ->get();
    return view('OfficeView.OfficeNotifications', compact('notifications'));
}


public function show($id)
{
    $notification = Notification::find($id);

    if (!$notification) {
        return response()->json(['error' => 'Notification not found.'], 404);
    }

    // Mark notification as read
    $notification->is_read = 'yes';
    $notification->save();

    return response()->json([
        'title' => $notification->title,
        'message' => $notification->message,
        'date_time' => $notification->created_at->format('Y-m-d H:i:s'), // Format to include date and time
        'created_at' => $notification->created_at->diffForHumans(),
    ]);
    
}
public function sendComplaint(Request $request)
{
    $request->validate([
        'office_id' => 'required|string',
        'title' => 'required|string ',
        'message' => 'required|string',
    ]);

    Notification::create([
        'office_id' => $request->office_id,
        'title' => $request->title,
        'message' => $request->message,
        'is_read' => 'no',
    ]);
 
    return response()->json(['success' => 'Notification sent to the office!']);
}
public function destroy($id)
{
    $notification = Notification::find($id);

    if (!$notification) {
        return back()->with('error', 'Notification not found.');
    }

    $notification->delete();

    return back()->with('success', 'Notification deleted successfully.');
}

public function clearByOffice(Request $request)
{
    $request->validate([
        'office_id' => 'required|string',
    ]);

    Notification::where('office_id', $request->office_id)->delete();

    return response()->json(['success' => 'All notifications for this office have been cleared.']);
}

}
