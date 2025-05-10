<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MainOffice;
use App\Models\Accounts;
use App\Models\SubOffice;
use App\Models\survey_responses;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // public function showOfficeLoginForm()
    // {
    //     $offices = MainOffice::all(); // Fetch main offices from the database


    //     return view('loginSection.officeLogin', compact('offices'));
    // }
    // public function showAdminLoginForm()
    // {
        
    //     return view('loginSection.adminLogin' );
    // }
//     public function loginOffice(Request $request)
//     {
//         $request->validate([
//             'office' => 'required',
//             'passcode' => 'required|digits:6',
//         ]);

//         // Validate office and passcode (Modify this according to your authentication logic)
//         $office = MainOffice::find($request->office);
  
//         // Check if office exists and if passcode matches
//         if (!$office || $request->passcode !== $office->passcode) {
//             return response()->json(['error' => 'Incorrect passcode'], 401); // Send error response
//         }
//   session(['office_name' => $office->office_name]); 
//   session(['office_id' => $office->office_id]); 
 
//   // Store office_id in session
//         // Redirect to office page
//         return redirect()->route('dashboard_with_score');

//     }

 

// public function loginAdmin(Request $request) {
//     $request->validate([
//         'password' => 'required'
//     ]);

//     if ($request->password === "admin") {  // Correct comparison
//         return view('AdminDashboard');
//     }

//     return back()->with('error', 'Invalid password');
// }

 

public function login(Request $request)
{
    $request->validate([
        'office_id' => 'required',
        'password' => 'required|digits:6',
    ]);

    // Find account using the provided ID
    $account = Accounts::where('accountID', $request->office_id)->first();

    if (!$account || !Hash::check($request->password, $account->passcode)) {
        return redirect()->back()->withErrors(['error' => 'Incorrect credentials'])->withInput();
    }

    if ($account->account_type === 'admin') {
        $account->update(['last_login' => now()]);
        session(['account_type' => $account->account_type]);

        Log::info("Admin logged in with ID: {$account->accountID}");

        return redirect('AdminDashboard');
    } 
    
    elseif ($account->account_type === 'office') {
        $mainOffice = MainOffice::where('office_id', $account->accountID)->first();
        $officeName = $mainOffice ? $mainOffice->office_name : 'Unknown Office';

        session([
            'office_name' => $officeName,
            'office_id' => $account->accountID,
            'account_type' => $account->account_type
        ]);

        $account->update(['last_login' => now()]);

        Log::info("Main Office '{$officeName}' logged in.");

        return redirect()->route('dashboard_with_score');
    } 
    
    elseif ($account->account_type === 'section') {
        $subOffice = SubOffice::where('accountID', $request->office_id)->first();

        if ($subOffice) {
            session([
                'sub_office_id' => $subOffice->id,
                'account_type' => $account->account_type
            ]);

            Log::info("Section '{$subOffice->sub_office_name}' logged in.");

            return redirect()->route('section_dashboard');
        } else {
            return redirect()->back()->with('error', 'Sub-office not found.');
        }
    }
}

}
