<?php

namespace App\Http\Controllers;

use App\Models\MainOffice;
use App\Models\Service;
use App\Models\SubOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subOffices = SubOffice::all(); // Fetch all sub-offices
        
    
      
    $services = Service::all();
        return view('SubOfficeList')->with('subOffices', $subOffices)->with('services', $services);
    }
    

    /**
     * Show the form for creating a new resource.
     */
 
    
   

    public function store(Request $request)
    {
        $mainOfficeId = $request->input('main_office_id');
    
        // Count existing sub-offices for this main office
        $count = SubOffice::where('main_office_id', $mainOfficeId)->count();
    
        // Generate the accountID based on the count of existing sub-offices
        $accountID = $mainOfficeId . '-SEC' . ($count + 1);
    
        // Create a new sub-office
        $sub = new SubOffice();
        $sub->sub_office_name = $request->input('sub_office_name');
        $sub->main_office_id = $mainOfficeId;
        $sub->office_admin = $request->input('sub_office_admin');
        $sub->accountID = $accountID; // Set the generated accountID
    
        // Save the sub-office to the database
        $sub->save();
    
        // Log the creation of the new sub-office
        Log::info('New SubOffice/Section created', [
            'Created By:' => "Admin",   
            'sub_office_name' => $sub->sub_office_name,
            'sub_office_accountID' => $accountID,
            'sub_office_admin' => $sub->office_admin,
        ]);
    
        // Redirect to the sub-office show page with success message
        return redirect()->route('subOffice.show', $mainOfficeId)->with('success', 'Sub Office Added successfully!');
    }
    
    public function create($main_office_id)
    {
        $mainOffice = MainOffice::findOrFail($main_office_id);
        return view('AddSubOffice', compact('mainOffice'));
    }
    /**
     * Display the specified resource.
     */
    public function show($main_office_id)
    {
        $subOffices = SubOffice::where('main_office_id', $main_office_id)->get();
        $mainOffice = MainOffice::where('office_id', $main_office_id)->firstOrFail();
        
        // Get all services linked to the main office
        $services = Service::where('main_office_id', $main_office_id)->get();
    
        // Check if all services for this main office have NULL sub_office_id
        $servicesWIthSimilarMainAndSub = SubOffice::where('main_office_id', $main_office_id)
        ->where('sub_office_name', $mainOffice->office_name)
        ->exists();
        


          // Attach the services count dynamically
          foreach ($subOffices as $subOffice) {
            $services_count = Service::where('sub_office_id', $subOffice->id)->count();
    
            if ($subOffice->servicesCount !== $services_count) { // Use correct column name
                $subOffice->servicesCount = $services_count;
                $subOffice->save(); // Save the updated count to the database
            }
        }




        if ($servicesWIthSimilarMainAndSub) {
            return view('MainOfficeServiceList', compact('services', 'mainOffice'));
        } else {
            return view('SubOfficeList', compact('subOffices', 'mainOffice'));
        }
    }
    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subOffice = SubOffice::findOrFail($id);
        $mainOffices = MainOffice::all(); // Fetch all main offices for dropdown
    
        return view('EditSubOffice', compact('subOffice', 'mainOffices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the sub-office or fail
        $subOffice = SubOffice::findOrFail($id);
    
        // Store old data for logging
        $oldData = $subOffice->toArray();
    
        // Update the sub-office details
        $subOffice->main_office_id = $request->main_office_id;
        $subOffice->sub_office_name = $request->sub_office_name;
        $subOffice->office_admin = $request->office_admin;
        $subOffice->save();
    
        // Log the update action
        Log::info('SubOffice/Section updated', [
            'Updated By:' => "Admin",   

            'sub_office_id' => $subOffice->id,
            'old_data' => $oldData,
            'new_data' => $subOffice->toArray(),
        ]);
    
        // Pass main_office_id to the route and redirect with success message
        return redirect()->route('subOffices.show', $subOffice->main_office_id)
            ->with('success', 'Sub Office updated successfully!');
    }
 
    public function destroy(string $id)
    {
        // Find the sub-office by ID or fail
        $sub = SubOffice::findOrFail($id);
    
        // Get the main office ID before deleting
        $mainOfficeId = $sub->main_office_id;
    
        // Log the deletion request
        Log::warning('Deleting SubOffice/Section', [
            'Deleted By:' => "Admin",   

            'sub_office_id' => $sub->id,
            'sub_office_name' => $sub->sub_office_name,
            'main_office_id' => $mainOfficeId,
        ]);
    
        // Delete all services linked to this sub-office and log the action
        $affectedServices = Service::where('sub_office_id', $id)->get();
        if ($affectedServices->isNotEmpty()) {
            Log::warning('Deleting related services for SubOffice/Section', [
                'Deleted By:' => "Admin",   

                'affected_services_count' => $affectedServices->count(),
                'sub_office_id' => $id,
            ]);
            Service::where('sub_office_id', $id)->delete();
        }
    
        // Delete the sub-office
        $sub->delete();
    
        // Log the successful deletion of the sub-office
        Log::warning('SubOffice/Section deleted', [
            'Deleted By:' => "Admin",   

            'sub_office_id' => $sub->id,
            'sub_office_name' => $sub->sub_office_name,
            'main_office_id' => $mainOfficeId,
        ]);
    
        // Redirect back to the sub-office list for the same main office
        return redirect()->route('subOffices.show', $mainOfficeId)
            ->with('success', 'Sub Office Deleted successfully!');
    }
    
}
