<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\MainOffice;
use App\Models\SubOffice;
use App\Models\Service;
use App\Models\survey_responses;

use Illuminate\Http\Request;

class MainOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainOffice  = MainOffice::all();
        foreach ($mainOffice as $office) {
            // $office->subOfficeCount = SubOffice::where('main_office_id', $office->office_id)->count();
            $subOfficeCount = SubOffice::where('main_office_id', $office->office_id)->count();

            if ($office->subOfficeCount !== $subOfficeCount) {
                $office->subOfficeCount = $subOfficeCount;
                $office->save(); // Save the updated count to the database
            }
        }

        return view('MainOfficeList')->with('main',$mainOffice);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AddMainOffice');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $main = new MainOffice();
        $main->office_id = $request->input('office_id');
        $main->office_name = $request->input('office_name');
        $main->office_admin = $request->input('office_admin');
 
        $main->save();
        Log::info('MainOffice created', [
            'Created by:' => "Admin",
            'main_office_id' => $main->id,
            'data' => $main->toArray(),
        ]);
    
        return redirect()->route('mainOffice.index')->with('success', 'Main Office Added successfully!') ;
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mainOffice = MainOffice::findOrFail($id);
        return view('EditMainOffice', compact('mainOffice'));
    }
    

    /**
     * Update the specified resource in storage.
     */ 
    public function update(Request $request, string $id)
    {
        // Find the main office or fail
        $mainOffice = MainOffice::findOrFail($id);
    
        // Store old data before the update
        $oldOfficeId = $mainOffice->office_id;
        $oldOfficeName = $mainOffice->office_name;
    
        // Check if there are related SubOffices and Services
        $affectedSubOffices = SubOffice::where('main_office_id', $oldOfficeId)->get();
        $affectedServices = Service::where('main_office_id', $oldOfficeId)->get();
        $affectedSurveyResponses = survey_responses::where('main_office', $oldOfficeName)->get();
       $oldData = $mainOffice->toArray();
    
        // Update the MainOffice data
        $mainOffice->office_id = $request->office_id;
        $mainOffice->office_name = $request->office_name;
        $mainOffice->office_admin = $request->office_admin;
        $mainOffice->save();
    
        // If no related records exist, return an error
        if ($affectedSubOffices->isEmpty() && $affectedServices->isEmpty() && $affectedSurveyResponses->isEmpty()) {
            Log::info('MainOffice updated', [
                'Updated By:' => "Admin",
                'main_office_id' => $mainOffice->id,
                'old_data' => $oldData,
                'new_data' => $mainOffice->toArray(),
            
            ]);   redirect()->route('mainOffice.index')->with('success', 'Main Office updated successfully!');
        }
    
        // Save old data for logging purposes
     
        // Update related SubOffices if any exist
        if ($affectedSubOffices->isNotEmpty()) {
            SubOffice::where('main_office_id', $oldOfficeId)
                ->update(['main_office_id' => $request->office_id]);
        }
    
        // Update related Services if any exist
        if ($affectedServices->isNotEmpty()) {
            Service::where('main_office_id', $oldOfficeId)
                ->update(['main_office_id' => $request->office_id]);
        }
    
        // Update related Survey Responses if any exist
        if ($affectedSurveyResponses->isNotEmpty()) {
            survey_responses::where('main_office', $oldOfficeName)
                ->update(['main_office' => $request->office_name]);
        }
    
        // Log the update action
        Log::info('MainOffice updated', [
            'Updated By:' => "Admin",
            'main_office_id' => $mainOffice->id,
            'old_data' => $oldData,
            'new_data' => $mainOffice->toArray(),
        
        ]);
    
        // Redirect with success message
        return redirect()->route('mainOffice.index')->with('success', 'Main Office updated successfully!');
    }
    
    
 

    public function destroy(string $id)
    {
        // Find the main office or fail
        $main = MainOffice::findOrFail($id);
        $mainOfficeId = $main->office_id;
    
        // Log the deletion of the main office before deleting
        Log::warning('Deleting MainOffice', [
            'Deleted By:' => "Admin",
            'main_office_id' => $main->id,
            'main_office_data' => $main->toArray(),
        ]);
    
        // Delete all services linked to this main office and log the action
        $affectedServices = Service::where('main_office_id', $mainOfficeId)->get();
        if ($affectedServices->isNotEmpty()) {
            Log::warning('Deleting related services for MainOffice', [
                'Deleted By:' => "Admin",

                'affected_services_count' => $affectedServices->count(),
                'main_office_id' => $mainOfficeId,
            ]);
            Service::where('main_office_id', $mainOfficeId)->delete();
        }
    
        // Delete all sub-offices linked to this main office and log the action
        $affectedSubOffices = SubOffice::where('main_office_id', $mainOfficeId)->get();
        if ($affectedSubOffices->isNotEmpty()) {
            Log::warning('Deleting related sub-offices for MainOffice', [
                'Deleted By:' => "Admin",

                'affected_sub_offices_count' => $affectedSubOffices->count(),
                'main_office_id' => $mainOfficeId,
            ]);
            SubOffice::where('main_office_id', $mainOfficeId)->delete();
        }
    
        // Delete the main office itself
        $main->delete();
    
        // Final log after deletion
        Log::warning('MainOffice deleted', [
            'Deleted By:' => "Admin",

            'main_office_id' => $main->office_id,
        ]);
    
        // Redirect with success message
        return redirect()->route('mainOffice.index')->with('success', 'Main Office Deleted successfully!');
    }
    
}
