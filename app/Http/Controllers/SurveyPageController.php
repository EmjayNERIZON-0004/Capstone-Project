<?php

namespace App\Http\Controllers;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MainOffice;
use App\Models\SubOffice;
use App\Models\Service;
use App\Models\survey_responses;
class SurveyPageController extends Controller
{
    function page1(){
        return view('surveyPage/ClientSurveyP1');
    }
    
    function page2(){
        return view('surveyPage/ClientSurveyP2');
    }
    function page3(){
        return view('surveyPage/ClientSurveyP3');
    }
    function page4(){
        return view('surveyPage/ClientSurveyP4');
    }

    function ccQuestion(){
        return view('surveyPage.CitizenCharterQuestion');
    }
    public function showMainOffice(Request $request)
    {
        // Retrieve the form data from the request
        Session::put('age', $request->input('age'));
        Session::put('sex', $request->input('sex'));
        Session::put('customerType', $request->input('customerType'));
        Session::put('mainOffice', $request->input('mainOffice'));
        Session::put('subOffice', $request->input('subOffice'));
       
          $mainOffices = MainOffice::all();

        // Pass the data to the next view
        return view('surveyPage.ClientSurveyP2', compact('mainOffices'));
    }



    public function checkOffice(Request $request)
    {
 
        
            $officeId = $request->input('main_office'); // Get the selected office ID (as a string)
            // Session::put('mainOffice', $request->input('mainOffice'));
            // Session::put('subOffice', $request->input('subOffice'));
             if (!$officeId) {
                return back()->with('error', 'Please select a main office.');
            }
        
            // Fetch main office details (Ensure you're comparing as a string)
            $mainOffice = MainOffice::where('office_id', $officeId)->first();
            
            if (!$mainOffice) {
                return back()->with('error', 'Selected office not found.');
            }
        
            // Check if the office has sub-offices
            $subOffices = SubOffice::where('main_office_id', $officeId)->get();
            $hasSubOffice = $subOffices->isNotEmpty();
        
        

                Session::put('mainOffice', $request->input('main_office') );
                
                Session::put('subOffice', $request->input('subOffice'));
                  $subOfficeId = $request->input('subOffice');
                   // Get the sub-office ID (if exists)


                return view('surveyPage/selectSubOffice')
                    ->with([
                        'selected_office' => $mainOffice,
                        'sub_offices' => $subOffices,
                        'mainOffice' => $officeId,
                        'subOffice' => $subOfficeId
                    ]);

       
       
        
    }


    public function processSubOffice(Request $request) {
        $validated = $request->validate([
            'sub_office_id' => 'required|exists:sub_offices,id',
        ]);
    
        // Retrieve the selected SubOffice
        $subOffice = SubOffice::find($validated['sub_office_id']);
    
        // Fetch services that match both main_office_id and sub_office_id
        $services = Service::where('main_office_id', $subOffice->main_office_id)
                            ->where('sub_office_id', $subOffice->id)
                            ->get();


                            Session::put('subOffice', $request->input('sub_office_id') );

                         
        // Pass the data to the view
        return view('surveyPage/ClientSurveyP3')->with([
            'selected_sub_office' => $subOffice,
            'main_office_id' => $subOffice->main_office_id,
            'services' => $services
        ]);
    }

    
public function submitServices(Request $request)
{
    // Validate the request data
 

    // Get the selected sub-office ID
    $subOfficeId = $request->input('subOffice');

    // Retrieve sub-office details
    $selectedSubOffice = SubOffice::findOrFail($subOfficeId);

    // Fetch services based on the selected sub-office
    $services = Service::where('sub_office_id', $subOfficeId)->get();

    $services_id = $request->input('services_id');
    Session::put('services_id', $request->input('services_id') );


        if($services_id == "others"){
            return view("surveyPage.ClientSurveyP4",compact('selectedSubOffice', 'services'));
        }
    // Redirect to the next page with the selected sub-office and services
    return view('surveyPage.CitizenCharterQuestion', compact('selectedSubOffice', 'services'));
}



public function awarenessQ(Request $request){

    // Get the selected value from the form
    $citizensCharter = $request->input('citizens_charter');

    Session::put('citizens_charter_awarenessQ', $citizensCharter );
    // Redirect back or to another page with a success message
    if ($citizensCharter === 'yes') {
      return view('surveyPage.CitizensCharter2');;
  } else {
      return view('surveyPage.viewCitizensCharter');
  }
 
}

public function sawQ(Request $request){

  $citizensCharter = $request->input('citizen_charter');
  Session::put('citizens_charter_sawQ',$citizensCharter  );

  if ($citizensCharter === 'Yes - it was easy to find' ||$citizensCharter === 'Yes - but it was hard to find' ) {
      return view('surveyPage.CitizensCharter3');;
  } else {
      return view('surveyPage.viewCitizensCharter');
  }
} 

public function storeCitizensCharterResponses(Request $request)
{
    $request->validate([
        'citizens_charter_awarenessQ' => 'required',
        'citizens_charter_sawQ' => 'required',
        'citizens_charter_usedQ' => 'required',
    ]);

    Session::put('citizens_charter_awarenessQ', $request->input('citizens_charter_awarenessQ'));
    Session::put('citizens_charter_sawQ', $request->input('citizens_charter_sawQ'));
    Session::put('citizens_charter_usedQ', $request->input('citizens_charter_usedQ'));


    return view('surveyPage.ClientSurveyP4');;
    // return redirect()->back()->with('success', 'Your answers were saved in the session.');
}

public function usedQ(Request $request){

  $citizensCharter = $request->input('citizen_charter');
  Session::put('citizens_charter_usedQ',$citizensCharter  );

  if ($citizensCharter === 'Yes'  ) {
      return view('surveyPage.ClientSurveyP4');;
  } else {
      return view('surveyPage.viewCitizensCharter');
  }
}

public function submitSQD(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'sqd1' => 'required',
        'sqd2' => 'required',
        'sqd3' => 'required',
        'sqd4' => 'required',
        'sqd5' => 'required',
        'sqd6' => 'required',
        'sqd7' => 'required',
        'sqd8' => 'required',
        'remarksType' => 'nullable|in:feedback,complaint,recommendation',
        'remarks' => 'nullable|string',
    ]);

    $mainOfficeId = session('mainOffice');
    $subOfficeId = session('subOffice');
    $serviceId = session('services_id');
   

    $mainOffice = MainOffice::where('office_id', $mainOfficeId)->first();
    $mainOfficeName = $mainOffice ? $mainOffice->office_name : null;

    $subOffice = SubOffice::where('id', $subOfficeId)->first();
    $subOfficeName = $subOffice ? $subOffice->sub_office_name : null;

    $service = Service::where('id', $serviceId)->first();
    $serviceName = $service ? $service->service_name : null;

    // Get remarks for sentiment analysis
    $remarks = $validatedData['remarks'];

    $maxRetries = 3;
    $delayBetweenRetries = 5;
    $sentiment = "undefined"; // Default sentiment

    // Loop to attempt calling sentiment analysis API with retries
    for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
        try {
            // Call the Python API for sentiment analysis
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('http://127.0.0.1:5000/analyze', [
                'text' => $remarks
            ]);
            
            Log::info('Flask API Response:', $response->json());

            // Decode the response from the API
            $sentimentData = $response->json();

            // Log the response for debugging
            Log::info('Sending remarks to Flask API:', ['remarks' => $remarks]);


            // Check for sentiment and set default if not found
            if (isset($sentimentData['sentiment'])) {
                $sentiment = strtolower($sentimentData['sentiment']);
                break; // Stop retrying if sentiment is received
            } else {
                Log::warning('Invalid Sentiment Response:', $sentimentData);
                $sentiment = "undefined"; // Set default sentiment to neutral if no sentiment is returned
            }
        } catch (Throwable $e) {
            Log::error('Sentiment API Error: ' . $e->getMessage());
            sleep($delayBetweenRetries);
            $sentiment = "undefined"; // Ensure sentiment defaults to neutral on error
        }
    }

    // Store the response in the database
    survey_responses::create([
        'age' => session('age'),
        'sex' => session('sex'),
        'customerType' => session('customerType'),
        'main_office' => $mainOfficeName,
        'office_transacted_with' => $subOfficeName,
        'service_availed' => $serviceName,
        'aware_of_citizen_charter' => session('citizens_charter_awarenessQ'),
        'saw_citizen_charter' => session('citizens_charter_sawQ'),
        'used_citizen_charter' => session('citizens_charter_usedQ'),
        'sqd1' => $validatedData['sqd1'],
        'sqd2' => $validatedData['sqd2'],
        'sqd3' => $validatedData['sqd3'],
        'sqd4' => $validatedData['sqd4'],
        'sqd5' => $validatedData['sqd5'],
        'sqd6' => $validatedData['sqd6'],
        'sqd7' => $validatedData['sqd7'],
        'sqd8' => $validatedData['sqd8'],
       'remarks_type' => $validatedData['remarksType'] ?? null,

        'remarks' => $validatedData['remarks'],
        'sentiment' => $sentiment, // Store sentiment result
    ]);


    session()->forget('mainOffice');
    session()->forget('subOffice');
    session()->forget('services_id');
    session()->forget('age');
    session()->forget('sex');
    session()->forget('customerType');
    session()->forget('citizens_charter_awarenessQ');
    session()->forget('citizens_charter_sawQ');
    session()->forget('citizens_charter_usedQ');


    // Redirect to a thank you page or another view
    return redirect()->route('thankyou');
}



public function showCitizenCharter(){

    return view('surveyPage.viewCitizensCharter');
}

}
