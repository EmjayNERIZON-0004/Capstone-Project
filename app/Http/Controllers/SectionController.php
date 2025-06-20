<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SubOffice;
use App\Models\survey_responses;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as FacadesCache;

class SectionController extends Controller
{

    public function profile()
{
    $sectionId = session('sub_office_id');
$section = SubOffice::with('mainOffice')->find($sectionId);

    $section = SubOffice::find($sectionId);
 
    if (!$section) { 
        return redirect()->back()->with('error', 'Office not found.');
    }

    return view('SectionView.SectionProfile', compact('section'));
}

 public function upload(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

         $sectionId = session('sub_office_id');

    $office = SubOffice::find($sectionId);
 
        // Delete old image if exists
        if ($office->image_path && file_exists(public_path('images/' . $office->image_path))) {
            unlink(public_path('images/' . $office->image_path));
        }

        // Save new image
        $file = $request->file('profile_image');
      $originalName = $file->getClientOriginalName();

    // Move the file to public/images using the original name
    $file->move(public_path('images'), $originalName);


        // Update DB
        $office->image_path = $originalName;
        $office->save();

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }
    public function index()
    {
        $sectionId = session('sub_office_id');
    $currentQuarter = Carbon::now()->quarter;
    $currentYear = Carbon::now()->year;
    $now = Carbon::now();
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    $section = SubOffice::find($sectionId);
    $services = Service::where('sub_office_id', $sectionId)->get();
    $servicesCount = $services->count();
    $totalResponses = survey_responses::where('office_transacted_with', $section->sub_office_name)
    ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
    ->count();


    $bothServices = Service::where('sub_office_id', $sectionId)
    ->where('services_type', 'both')
    ->get();

    $externalServices = Service::where('sub_office_id', $sectionId)
    ->where('services_type', 'external')
    ->get();

$internalServices = Service::where('sub_office_id', $sectionId)
    ->where('services_type', 'internal')
    ->get();
 
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];

    // Score calculator
    $calculateScore = function ($servicesCollection) use ($sqdColumns, $startOfQuarter, $endOfQuarter) {
        $total5s = $total4s = $totalValidResponses = 0;

        foreach ($servicesCollection as $service) {
            $responses = survey_responses::where('service_availed', $service->service_name)
                ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                ->get();

            foreach ($sqdColumns as $sqd) {
                $count5 = $responses->where($sqd, 5)->count();
                $count4 = $responses->where($sqd, 4)->count();
                $countNA = $responses->where($sqd, 'N/A')->count();
                $total = $responses->count();
                $valid = $total - $countNA;

                $total5s += $count5;
                $total4s += $count4;
                $totalValidResponses += $valid;
            }
        }

        return ($totalValidResponses > 0)
            ? ($total5s + $total4s) / $totalValidResponses
            : 0;
    };

    // External, internal scores
    $externalScore = $calculateScore($externalServices);
    $internalScore = $calculateScore($internalServices);

    // Overall score: only based on office_transacted_with
    $allResponses = survey_responses::where('office_transacted_with', $section->sub_office_name)
        ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->get();

    $overall5s = $overall4s = $overallValid = 0;

    foreach ($sqdColumns as $sqd) {
        $count5 = $allResponses->where($sqd, 5)->count();
        $count4 = $allResponses->where($sqd, 4)->count();
        $countNA = $allResponses->where($sqd, 'N/A')->count();
        $total = $allResponses->count();
        $valid = $total - $countNA;

        $overall5s += $count5;
        $overall4s += $count4;
        $overallValid += $valid;
    }

    $overallScore = ($overallValid > 0)
        ? ($overall5s + $overall4s) / $overallValid
        : 0;

    return view('SectionView.SectionDashboard', compact(
        'externalServices',
        'internalServices',
        'services',
        'section',
        'bothServices',
        'servicesCount',
        'totalResponses',
        'externalScore',
        'internalScore',
        'overallScore',
        'currentQuarter',
        'currentYear'
    ));

} 
  public function submission()
    {
        $sectionId = session('sub_office_id');
    $currentQuarter = Carbon::now()->quarter;
    $currentYear = Carbon::now()->year;
    $now = Carbon::now();
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    $section = SubOffice::find($sectionId);
    $services = Service::where('sub_office_id', $sectionId)->get();
    $servicesCount = $services->count();
    $totalResponses = survey_responses::where('office_transacted_with', $section->sub_office_name)
    ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
    ->count();


    $bothServices = Service::where('sub_office_id', $sectionId)
    ->where('services_type', 'both')
    ->get();

    $externalServices = Service::where('sub_office_id', $sectionId)
    ->where('services_type', 'external')
    ->get();

$internalServices = Service::where('sub_office_id', $sectionId)
    ->where('services_type', 'internal')
    ->get();
 
    $sqdColumns = ['sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8'];

    // Score calculator
    $calculateScore = function ($servicesCollection) use ($sqdColumns, $startOfQuarter, $endOfQuarter) {
        $total5s = $total4s = $totalValidResponses = 0;

        foreach ($servicesCollection as $service) {
            $responses = survey_responses::where('service_availed', $service->service_name)
                ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
                ->get();

            foreach ($sqdColumns as $sqd) {
                $count5 = $responses->where($sqd, 5)->count();
                $count4 = $responses->where($sqd, 4)->count();
                $countNA = $responses->where($sqd, 'N/A')->count();
                $total = $responses->count();
                $valid = $total - $countNA;

                $total5s += $count5;
                $total4s += $count4;
                $totalValidResponses += $valid;
            }
        }

        return ($totalValidResponses > 0)
            ? ($total5s + $total4s) / $totalValidResponses
            : 0;
    };

    // External, internal scores
    $externalScore = $calculateScore($externalServices);
    $internalScore = $calculateScore($internalServices);

    // Overall score: only based on office_transacted_with
    $allResponses = survey_responses::where('office_transacted_with', $section->sub_office_name)
        ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
        ->get();

    $overall5s = $overall4s = $overallValid = 0;

    foreach ($sqdColumns as $sqd) {
        $count5 = $allResponses->where($sqd, 5)->count();
        $count4 = $allResponses->where($sqd, 4)->count();
        $countNA = $allResponses->where($sqd, 'N/A')->count();
        $total = $allResponses->count();
        $valid = $total - $countNA;

        $overall5s += $count5;
        $overall4s += $count4;
        $overallValid += $valid;
    }

    $overallScore = ($overallValid > 0)
        ? ($overall5s + $overall4s) / $overallValid
        : 0;

    return view('SectionView.SectionSubmission', compact(
        'externalServices',
        'internalServices',
        'services',
        'section',
        'bothServices',
        'servicesCount',
        'totalResponses',
        'externalScore',
        'internalScore',
        'overallScore',
        'currentQuarter',
        'currentYear'
    ));

} 
public function getRankedSectionServices(int $subOffice)
{
    $now = Carbon::now();
    $isMonday = $now->isMonday();

    // Create a cache key unique to the subOffice and the current Monday's date
    $cacheKey = 'ranked_services_' . $subOffice . '_' . $now->startOfWeek()->format('Ymd');

    // If it's Monday and data is cached, return the cached version
    if ($isMonday && FacadesCache::has($cacheKey)) {
        return response()->json(FacadesCache::get($cacheKey));
    }

    $offices = Service::where('sub_office_id', $subOffice)->get();
    $totalOffices = $offices->count();
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    $sqdColumns = [
        'sqd1' => 'SQD1',
        'sqd2' => 'SQD2',
        'sqd3' => 'SQD3',
        'sqd4' => 'SQD4',
        'sqd5' => 'SQD5',
        'sqd6' => 'SQD6',
        'sqd7' => 'SQD7',
        'sqd8' => 'SQD8'
    ];

    $rankedOffices = $offices->map(function ($office) use ($sqdColumns, $startOfQuarter, $endOfQuarter) {
        $responses = survey_responses::where('service_availed', $office->service_name)
            ->whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
            ->get();

        $total5s = $total4s = $totalNAs = $totalValidResponses = 0;
        foreach ($sqdColumns as $key => $label) {
            $count5 = $responses->where($key, 5)->count();
            $count4 = $responses->where($key, 4)->count();
            $countNA = $responses->where($key, 'N/A')->count();
            $totalResponses = $responses->count();
            $validResponses = $totalResponses - $countNA;

            $total5s += $count5;
            $total4s += $count4;
            $totalNAs += $countNA;
            $totalValidResponses += $validResponses;
        }

        $overallScore = ($totalValidResponses > 0) ? ($total5s + $total4s) / $totalValidResponses : 0;

        return [
            'office_name' => $office->service_name,
            'overall_score' => $overallScore,
            'total_responses' => $responses->count(),
            'complaints' => $responses->where('remarks_type', 'complaint')->count(),
            'feedbacks' => $responses->where('remarks_type', 'feedback')->count(),
            'recommendations' => $responses->where('remarks_type', 'recommendation')->count(),
        ];
    })
    ->sortByDesc('overall_score')
    ->values();

    $result = [
        'totalServices' => $totalOffices,
        'rankedServices' => $rankedOffices
    ];

    // Cache the result only if it's Monday
    if ($isMonday) {
        FacadesCache::put($cacheKey, $result, now()->endOfDay()); // expires end of Monday
    }

    return response()->json($result);
}

}
