<?php
namespace App\Http\Controllers; 

use App\Models\Accounts;
use App\Models\MainOffice;
use App\Models\SubOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function store(Request $request)
    {
       
        $request->validate([
            'main_office_id' => 'required|string',
            'passcode' => 'required|digits:6',
        ]);
    
        $officeId = $request->main_office_id;
    
        // Detect account type by checking where the ID exists
        $isMain = MainOffice::where('office_id', $officeId)->exists();
        $isSub  = SubOffice::where('accountID', $officeId)->exists();
    
        if (!$isMain && !$isSub && $officeId !== 'admin123') {
            return redirect()->back()->with('error', 'This Office ID is not found.');
        }
    
        $accountType = $isMain ? 'office' : 'section';
    
        // Check if the account is already activated
        $accountExists = \App\Models\Accounts::where('accountID', $officeId)->exists();
    
        if ($accountExists) {
            return redirect()->back()->with('error', 'This Office Account is already activated.');
        }
    
        // Create the account
        $account = \App\Models\Accounts::create([
            'accountID'     => $officeId,
            'passcode'      => $request->input('passcode'),
            'account_type'  => $accountType,
        ]);
        Log::info('Account activated', [
            'accountID' => $officeId,
            'account_type' => $accountType,
            'time' => now(),
            'ip' => $request->ip(),
            // 'user_agent' => $request->userAgent(),
        ]);
    
        return redirect()->route('loginPage')->with('success', 'Account activated successfully.');
    }
       
    public function showActivationStatus()
    {
        $mainOffices = MainOffice::all()->map(function ($office) {
            $isActivated = Accounts::where('account_type', 'office')
                                ->where('accountID', $office->office_id)
                                ->exists();
            $office->activation_status = $isActivated ? 'Activated' : 'Not Activated';
            return $office;
        });
    
        $subOffices = SubOffice::all()->map(function ($section) {
            $isActivated = Accounts::where('account_type', 'section')
                                ->where('accountID', $section->accountID)
                                ->exists();
            $section->activation_status = $isActivated ? 'Activated' : 'Not Activated';
            return $section;
        });
    
        return view('AdminView.AdminAccountList', compact('mainOffices', 'subOffices'));
    }
    public function resetActivation($type, $id)
    {
        $deleted = Accounts::where('account_type', $type)
            ->where('accountID', $id)
            ->delete();
            if ($deleted) {
                Log::info('Account activation reset', [
                    'accountID' => $id,
                    'account_type' => $type,
                    'action' => 'reset',
                    'time' => now(),
                    'performed_by_ip' => request()->ip(),
                    // 'user_agent' => request()->userAgent(),
                ]);
            }
        return redirect()->route('account_list')
                         ->with('status', $deleted ? 'Activation reset successfully.' : 'No account found.');
    }
    
}
