<?php

namespace App\Http\Controllers;

use App\Models\MainOffice;
use App\Models\SubOffice;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServicesAvailedController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getServices(Request $request)
     {
         $query = DB::table('services');
 
         // Filter by sub_office_id if provided
         if ($request->has('office') && $request->office !== 'all') {
             $query->where('sub_office_id', $request->office);
         }
 
         // Filter by services_type if provided
         if ($request->has('type') && $request->type !== 'all') {
             $query->where('services_type', $request->type);
         }
 
         $services = $query->pluck('service_name')->unique()->values();
 
         return response()->json($services);
     }


    public function index()
    {
        //                                                                  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($sub_office_id)
    {
        $sub_office = SubOffice::findOrFail($sub_office_id);
   
        return view('AddOfficeService',compact('sub_office'));
    }


    public function createForMainOffice($main_office_id)
    {
        $mainOffice = MainOffice::findOrFail($main_office_id);
        
        return view('AddServiceToMain', compact('mainOffice'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'main_office_id' => 'required|exists:main_offices,id',
        //     'sub_office_id' => 'required|exists:sub_offices,id',
        //     'service_name' => 'required|string|max:255',
        // ]);
    
        // Insert the service into the database

        $mainOffice = MainOffice::where('office_id', $request->input('main_office_id'))->first();

        if (!$mainOffice) {
            return redirect()->back()->with('error', 'Main office not found.');
        }
        
        // Check if SubOffice already exists
        $existingSubOffice = SubOffice::where('id', $request->sub_office_id)->first();
        
        if (!$existingSubOffice) {
            //  Create a new SubOffice if it does not exist
            $subOffice = SubOffice::create([
                'main_office_id' => $mainOffice->office_id,
                'sub_office_name' => $mainOffice->office_name,
            ]);
        } else {
            // 🔹 Use the existing SubOffice
            $subOffice = $existingSubOffice;
        }





    $service =    Service::create([
            'main_office_id' => $request->input('main_office_id'),
            'sub_office_id' => $subOffice->id,
            'service_name' => $request->input('service_name'),
            'services_type' => $request->input('service_type'),
        ]);
        
      
        Log::info("A new service '{$service->service_name}' was added under main office '{$mainOffice->office_name}' and sub-office/section {$subOffice->sub_office_name}.");

        if (!$request->input('sub_office_id')) {
            return redirect()->route('servicesAvailed.showMainOffice', $request->input('main_office_id'))
                ->with('success', 'Service added successfully!');
        }
    
        // Redirect back to the services list for this sub-office
        return redirect()->route('servicesAvailed.show', $request->input('sub_office_id'))
            ->with('success', 'Service added successfully!');
    }

 
    public function showMainOffice($main_office_id)
    {   $mainOffice = MainOffice::where('office_id', $main_office_id)->firstOrFail();
        $services = Service::where('main_office_id', $main_office_id)->get();

          
        return view('MainOfficeServiceList', compact('mainOffice', 'services'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $sub_office_id)
    {
        $subOffice = SubOffice::findOrFail($sub_office_id);
        $services = Service::where('sub_office_id', $sub_office_id)->get();
        return view('officeServiceList', compact('subOffice', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(int $id)
{
    $service = Service::findOrFail($id);

    // Check if sub_office_id is null
    // if (is_null($service->sub_office_id)) {
    //     return redirect()->route('servicesAvailed.showMainOffice', $service->main_office_id)
    //         ->with('warning', 'This service is not linked to a sub-office.');
    // }
    
        $service = Service::findOrFail($id);
    
        // Ensure sub_office_id is explicitly passed (even if null)
        $sub_office_id = $service->sub_office_id; 
        $service_name = $service->service_name; 
        $services_type = $service->services_type; 
        $main_office_id = $service->main_office_id; 
    
        return view('EditOfficeService', compact('service_name','services_type', 'sub_office_id','main_office_id','id'));
    }
    
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'service_name' => 'required|string|max:255',
        // ]);
       
        $service = Service::findOrFail($id);
        $oldName = $service->service_name;
        $oldType = $service->services_type;
     $service->service_name = $request->service_name;
        $service->services_type = $request->service_type;

        $service->save();
        
        Log::info("Service '{$oldName}' (ID: {$service->id}) was updated to '{$service->service_name}' with type '{$service->services_type}'.");
      
        if (is_null($service->sub_office_id)) {
            return redirect()->route('servicesAvailed.showMainOffice', $service->main_office_id)
                ->with('success', 'Service updated successfully!');
        }

        return redirect()->route('servicesAvailed.show', $service->sub_office_id)
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id); // Find the service by ID
        $sub_office_id = $service->sub_office_id; // Store sub_office_id before deleting
        $main_office_id = $service->main_office_id; // Store main_office_id before deleting
      
        // Fetch the Main Office name
        $mainOffice = MainOffice::where('office_id', $main_office_id)->first();
    
        // Fetch the Sub-Office name (only if a sub-office exists)
        $subOffice = $sub_office_id ? SubOffice::where('id', $sub_office_id)->first() : null;
    
        // Delete the service
        $service->delete();
        $mainOfficeName = $mainOffice ? $mainOffice->office_name : 'Unknown Main Office';
        $subOfficeName = $subOffice ? $subOffice->sub_office_name : null;
        $serviceName = $service->service_name;
    
        Log::info("Service '{$serviceName}' under Sub-Office '{$subOfficeName}' of Main Office '{$mainOfficeName}' was deleted.");
        // Check if this was the last service for the sub-office
        // if ($sub_office_id !== null) {
        //     $remainingServices = Service::where('sub_office_id', $sub_office_id)->count();
    
        //     // If no more services exist for this sub-office, delete the sub-office
        //     if ($remainingServices === 0) {
        //         SubOffice::where('id', $sub_office_id)->delete();
        //         $subOffice = null; // Set to null after deletion
        //     }
        // }
    
        // // If the service belongs to the Main Office (no sub-office ID)
        // if ($sub_office_id === null) {
        //     return redirect()->route('subOffices.show', $main_office_id)
        //         ->with('success', 'Service deleted successfully!');
        // }
    
        // If the sub-office name matches the main-office name, redirect to Main Office Service List
        // if ($subOffice && $mainOffice && $subOffice->sub_office_name === $mainOffice->office_name) {
        //     return redirect()->route('servicesAvailed.showMainOffice', $main_office_id)
        //         ->with('success', 'Service deleted successfully!');
        // }
    
        // // If SubOffice was deleted, redirect back to the Main Office's SubOffice list
        // if ($subOffice === null) {
        //     return redirect()->route('subOffices.show', $main_office_id)
        //         ->with('success', 'Sub-office was removed since it had no more services.');
        // }
    
        // Otherwise, redirect to the Sub-Office’s service list
        return redirect()->route('servicesAvailed.show', $sub_office_id)
            ->with('success', 'Service deleted successfully!');
    }
    
    
}
