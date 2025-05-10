<?php

namespace App\Http\Controllers;
use App\Models\survey_verification;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class SurveyVerificationController extends Controller
{

    public function showForm()
    {
        return view('surveyPage.ClientSurvey1'); // Ensure you have client_satisfaction.blade.php in resources/views
    }

    public function generateTransactionNumber(Request $request)
    {
        $main_office_id = session('office_id');

        // Ensure a unique transaction number
        do {
            $random_number = mt_rand(100000, 999999); // Generate a random 6-digit number
            $transaction_no = $main_office_id . '-' .  now()->format('mdy-His');;
            $exists = survey_verification::where('transaction_no', $transaction_no)->exists();
        } while ($exists); // Repeat if transaction number already exists
    
        // Store in the database
        $survey = survey_verification::create([
            'transaction_no' => $transaction_no,
            'status' => 0 // Default: Not verified
        ]); 
        session(['transaction_no' => $transaction_no]); 
        return view('OfficeDashboardPages.OfficeTransactionID');
             }

             public function verifyTransaction(Request $request)
             {
                 $request->validate([
                     'transaction_number' => 'required|string'
                 ]);
         
                 $survey = survey_verification::where('transaction_no', $request->transaction_number)->first();
         
                 if (!$survey) {
                    return back()->with('error', 'Transaction number not found!');

                 }
         
                 // Mark as verified
                 $survey->update(['status' => 1]);
         
                 return redirect()->route('page1')->with('success', 'Verified!');
                }


                public function generateQrCode()
                {
                    // Generate the QR code with the value of $transact_id
                 
                    // You can either return it directly to the view or save the image
                    return view('transaction.qr_code' );
                } 
}
