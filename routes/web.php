<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainOfficeController;
use App\Http\Controllers\ServicesAvailedController;
use App\Http\Controllers\SubOfficeController;
use App\Http\Controllers\SurveyPageController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OfficeDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SurveyResponseController;
use App\Models\survey_responses;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SurveyReportsController;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NoTransactionController; 
use App\Http\Controllers\RequestController; use Carbon\Carbon;

 use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Models\MainOffice;
 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/reports',function(){
        $now = Carbon::now(); // Get current date and time using Carbon
    $currentYear = Carbon::now()->year;  
    // Get the start and end of the current quarter
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    // Get the office name (you can customize this part based on your logic)
   
    // Get survey responses for the current quarter using whereBetween()
    $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
    ->whereYear('created_at', $currentYear)    
    ->get();

    // Count the total responses, positive and negative sentiments
    $total_responses = $responses->count();
return view('AdminView.AdminReportTable',compact('total_responses'));
});

Route::get('/service-overall-satisfaction/{service_type}', [AdminViewController::class, 'service_overall_satisfaction']);
Route::get('/service-weighted_average/{service_type}', [AdminViewController::class, 'service_weighted_average']);
















Route::get('/change-light', function () {
    Session::put('mode', 'light');
    return redirect()->back();
})->name('change_mode_light');

Route::get('/change-dark', function () {
    Session::put('mode', 'dark');
    return redirect()->back();
})->name('change_mode_dark');


Route::get('/subOffices/{main_office_id}', [SubOfficeController::class, 'show'])->name('subOffices.show');
 


Route::get('/subOffice/create/{main_office_id}', [SubOfficeController::class, 'create'])->name('subOffice.create');
Route::get('/officeService/create/{sub_office_id}', [ServicesAvailedController::class, 'create'])->name('officeService.create');
 
Route::get('/mainOffice/{main_office_id}/add-service', [ServicesAvailedController::class, 'createForMainOffice'])
    ->name('servicesAvailed.createForMainOffice');
    
    Route::get('/mainOffice/{main_office_id}/services', [ServicesAvailedController::class, 'showMainOffice'])
    ->name('servicesAvailed.showMainOffice');


 
// check
  
    Route::get('/page-sub-office', function () {
        return view('surveyPage/selectSubOffice');
    })->name('page-subOffice');
    
    Route::get('/page-services', function () {
        return view('surveyPage/ClientSurveyP3');
    })->name('page-service');
    

    Route::get('/CitizensCharterPage1', function () {
        return view('surveyPage/CitizensCharter1');
    })->name('CitizensCharter1');
    Route::get('/CitizensCharterPage2', function () {
        return view('surveyPage/CitizensCharter2');
    })->name('CitizensCharter2');
    Route::get('/CitizensCharterPage3', function () {
        return view('surveyPage/CitizensCharter3');
    })->name('CitizensCharter3');
    
  
  
   
    Route::get('/Login', function () {
        return view('LoginView.loginPage');
    })->name('loginPage')->middleware('logged_in');



 



 

Route::post('/clear-transaction', function (Request $request) {
    session()->forget('transaction_no'); // Remove only 'transaction_no' session
    return response()->json(['message' => 'Transaction session cleared']);
})->name('clearTransaction');

Route::get('/dashboard-data', function () {
    return response()->json([
        'totalResponses' => 120,
        'totalServices' => 10,
        'lastMonthRating' => 4.5,
        'complaints' => 5,
        'positiveFeedback' => 95,
        'agreePercentage' => 80
    ]);
});

Route::get('/create-account', function(){
    return view('LoginView.createAccount');
    
})->name('account-create');



Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');





 use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportControllers;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServiceTransactionCount;
use App\Http\Controllers\ServiceTransactionCountController;
use App\Http\Controllers\SurveyAnalyticsController;
use App\Http\Controllers\TransactionCountController;

 Route::get('/feedbacks/{office_name}', [FeedbackController::class, 'viewFeedbacks'])->name('view_feedbacks');
  

Route::get('/office/notifications', [FeedbackController::class, 'index'])->name('office.notifications');
    
Route::get('/office/notifications/{id}', [FeedbackController::class, 'show'])->name('office.notifications.view');

Route::post('/office/notifications/read/{id}', [FeedbackController::class, 'markAsRead'])->name('office.notifications.read');
Route::post('/notifications/send-complaint', [FeedbackController::class, 'sendComplaint'])->name('notifications.sendComplaint');
Route::delete('/notifications/{id}', [FeedbackController::class, 'destroy'])->name('notifications.destroy'); 

Route::post('/notifications/clear', [FeedbackController::class, 'clearByOffice'])->name('notifications.clearByOffice');



Route::get('/office-login', [LoginController::class, 'showOfficeLoginForm'])->name('office.login.form');
Route::post('/Admin', [LoginController   ::class, 'login'])->name('office.login');
Route::get('/admin-login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'loginAdmin'])->name('admin.login');



 
Route::resource('/mainOffice',MainOfficeController::class);
Route::resource('/subOffice',SubOfficeController::class);
Route::resource('/servicesAvailed',ServicesAvailedController::class);

Route::get('/citizens-charter',[SurveyPageController::class,'ccQuestion']);


Route::post('/citizens-charter-survey/store', [SurveyPageController::class, 'storeCitizensCharterResponses'])
    ->name('citizens.charter.store');


    Route::group(['prefix' => 'CSM-SDO-SCC-Survey'],function(){
        Route::get('/Overview', function(){
return view ('surveyPage.Overview');
        })->name('overview') ;

    Route::get('/Page1', [SurveyPageController::class,'page1'])->name('page1') ;
    Route::get('/Page2', [SurveyPageController::class, 'showMainOffice'])->name('selectOffice');
    Route::post('/Page3', [SurveyPageController::class, 'checkOffice'])->name('check.office');
    Route::post('/Page4', [SurveyPageController::class, 'processSubOffice'])->name('submit-suboffice');
    Route::post('/Page5', [SurveyPageController::class, 'submitServices'])->name('submit-services');
    Route::post('/Page6', [SurveyPageController::class, 'awarenessQ'])->name('awarenessQ');
    Route::post('/Page7', [SurveyPageController::class, 'sawQ'])->name('sawQ');
    Route::post('/Page8', [SurveyPageController::class, 'usedQ'])->name('usedQ');
    Route::get('/Thankyou-you-for-your-response',function(){ return view('thankyoupage');  })->name('thankyou');
    Route::post('/thankyou', [SurveyPageController::class, 'submitSQD'])->name('submitSQD');
    Route::get('/CitizensCharter', [SurveyPageController::class, 'showCitizenCharter'])->name('showCitizenCharter');
    });

 
//OFFICE



Route::middleware(['logged_out'])->group(function () {
//MIDDLEWARE


///OFFICE
Route::group(['prefix' => 'Office'],function(){
    Route::get('/Dashboard', [OfficeDashboardController::class,'showDashboard'])->name('showDashboard');
    Route::get('/SurveyList/{quarter}/{year}', [OfficeDashboardController::class, 'showSurveys'])->name('showSurveys');
    Route::get('/Dashboard', [OfficeDashboardController::class, 'computeOverallScore'])->name('dashboard_with_score');
        Route::get('/OfficeProfile',[OfficeDashboardController::class,'profile']);
   Route::post('/profile/upload', [OfficeDashboardController::class, 'upload'])->name('office.profile.upload');

});
Route::get('/office/dashboard', [OfficeDashboardController::class, 'index'])->name('office.dashboard');
Route::get('/get-services/{subOfficeName}', [OfficeDashboardController::class, 'getServices']);
Route::get('/office-qrcodes', [OfficeDashboardController::class, 'officeQRCodes'])->name('office.qrcodes');
Route::get('/api/ranked-section/{MainOffice}', [OfficeDashboardController::class, 'getRankedSectionOffices']);
Route::get('/scores-sub_offices', [OfficeDashboardController::class, 'getRankedSubOffices']);


Route::get('/api/section-performance/{mainOffice}', [OfficeDashboardController::class, 'section_score_quarterly']);







//ADMIN
Route::group(['prefix' => 'Admin'],function(){


    Route::get('/OfficeManagement', [AdminViewController::class, 'OfficeManagement'])->name('mainOffice');
    Route::get('/go-back-suboffice', [AdminViewController::class, 'goBackToSubOffice'])->name('goBackToSubOffice');
    Route::get('/go-back-main-office', [AdminViewController::class, 'goBackToMainOffice'])->name('goBackToMainOffice');
    Route::get('/go-back-services', [AdminViewController::class, 'goBackToServices'])->name('goBackToServices');
    Route::get('/OfficesRemarks/{quarter}/{year}', [AdminViewController::class, 'Admin_OfficeRemarks'])->name('OfficeRemarks');
    Route::get('/api/ranked-offices/{quarter}/{year}', [AdminViewController::class, 'getRankedOffices']);
    Route::get('/api/overall-ranked-office/{quarter}/{year}', [AdminViewController::class, 'overallRankedOffice']);
    Route::get('/overall-score2', [AdminViewController::class, 'getOverallSurveyScore']);
    Route::get('/overall-total-score', [AdminViewController::class, 'getOverall']);
   

    Route::get('/api/monthly-survey-scores', [AdminViewController::class, 'getMonthlySurveyScores']);

    Route::get('/api/quarterly-survey-scores', [AdminViewController::class, 'getQuarterlySurveyScores']);
    Route::get('/api/yearly-survey-scores', [AdminViewController::class, 'getYearlySurveyScores']);
    Route::get('/api/getServicePerformanceChart', [AdminViewController::class, 'getServicePerformanceChart']);
    Route::get('/api/getOverallScoreByMainOffice', [AdminViewController::class, 'getOverallScoreByMainOffice']);


    Route::get('/Report',[AdminViewController::class,'reports'])->name('Report');  
    Route::get('/top-offices-per-sqd', [AdminViewController::class, 'getTopOfficesPerSQD']);
    Route::get('/top-section-per-sqd', [AdminViewController::class, 'getTopSectionPerSQD']);
    Route::get('/top-service-per-sqd', [AdminViewController::class, 'getTopServicePerSQD']);
    Route::get('/test', [AdminViewController::class, 'test']);
    Route::get('/Surveys', [AdminViewController::class, 'surveys'])->name('survey.responses');
    Route::get('OverallRating',function(){
        return view ('AdminView.AdminOverallRating');
    })->name('SQDDashboard');
    
Route::get('valid-survey',[AdminViewController::class,'valid_survey'])->name('valid_surveys');
Route::get('get-valid-survey/{quarter}/{year}',[AdminViewController::class,'get_valid_survey'])->name('get_valid_survey');
Route::get('/valid-survey-analytics/{year}/{mode?}', [AdminViewController::class, 'get_valid_survey_analytics']);
Route::get('/response-counts/{year}/{mode}', [AdminViewController::class, 'get_response_counts']);

});
        Route::get('/AdminDashboard',[AdminViewController::class,'dashboard'])->name('Main');
        Route::get('/sentiments-data/{sentiment}', [AdminViewController::class, 'showSentimentData']);
       
        Route::get('Concerns',function(){
            return view('AdminView.AdminConcernsList');
        })->name('concerns_feedbacks');
    
        Route::get('rating-history',function(){
        $years_cb = survey_responses::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderByDesc('year')
        ->pluck('year');

         $quarter_cb = survey_responses::selectRaw('QUARTER(created_at) as quarter')
        ->distinct()
        ->orderBy('quarter')
        ->pluck('quarter');
        $currentYear = now()->year;
        $currentQuarter = ceil(now()->month / 3);
        
            return view('AdminView.AdminRatingHistory',compact('years_cb','quarter_cb',  'currentYear','currentQuarter'));
        })->name('concerns_feedbacks');




        Route::get('PositiveFeedbacks',function(){
            return view('AdminView.AdminPositiveList');
        })->name('positive_feedbacks');

        Route::get('OfficeRemarks',function(){
            
        $years_cb = survey_responses::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderByDesc('year')
        ->pluck('year');

         $quarter_cb = survey_responses::selectRaw('QUARTER(created_at) as quarter')
        ->distinct()
        ->orderBy('quarter')
        ->pluck('quarter');
        $currentYear = now()->year;
        $currentQuarter = ceil(now()->month / 3);
        
            return view('AdminView.AdminOfficeRemarks',compact('years_cb','quarter_cb','currentYear','currentQuarter'));
        })->name('OfficeRemarks');
});











Route::get('/submit-transaction', [ServiceTransactionCountController::class, 'index'])->name('submit.transaction.form');
Route::post('/submit-transaction', [ServiceTransactionCountController::class, 'store'])->name('submit.transaction');

Route::post('/requests/store', [RequestController::class, 'store'])->name('requests.store');
Route::get('/requests/status/{office_id}', [RequestController::class, 'checkStatus'])->name('requests.status');
Route::get('/approved-complaints', [RequestController::class, 'approvedComplaints'])->name('complaints.approved');

Route::get('/request-data', [RequestController::class, 'getDashboardData'])->name('dashboard.data');

Route::get('/Admin/requests', [RequestController::class, 'manageRequests'])->name('requests.manage');
Route::post('/Admin/requests/update', [RequestController::class, 'updateRequest'])->name('requests.update');
Route::get('/requests/history', [RequestController::class, 'requestHistory'])->name('requests.history');


Route::get('/get-services', [ServicesAvailedController::class, 'getServices']);


Route::get('/response-rate-per-service/{type}', [ReportControllers::class, 'responseRatePerService']);
Route::get('/response-rate-per-service-all', [ReportControllers::class, 'responseRateOverall']);

// Route::get('/response-rate-per-service', [ReportControllers::class, 'responseRatePerService']);
Route::get('/reports_view',function(){
    $now = Carbon::now(); // Get current date and time using Carbon
    $currentYear = Carbon::now()->year;  
    // Get the start and end of the current quarter
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    // Get the office name (you can customize this part based on your logic)
   
    // Get survey responses for the current quarter using whereBetween()
    $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
    ->whereYear('created_at', $currentYear)    
    ->get();

    // Count the total responses, positive and negative sentiments
    $total_responses = $responses->count();
    return view('AdminView.AdminReport',compact('total_responses'));
})->name('AdminReports');


Route::get('/Section',function(){
    return view('SectionView.SectionDashboard');
})->name('section');


 

Route::get('/Section/Dashboard',[SectionController::class,'index'])->name('section_dashboard');

Route::get('/Section/Services',[SectionController::class,'submission'])->name('section_submission');

Route::post('/section/service-transaction-counts', [ServiceTransactionCountController::class, 'store'])->name('transaction_counts.store');

Route::get('report_score',[ReportControllers::class,'score']); 
Route::get('/survey-analytics/data', [SurveyAnalyticsController::class, 'getData']);
Route::get('/Analytics', [AdminViewController::class, 'adminSurveyAnalytics']);

Route::get('/Admin/Analytics',  function(){

    $now = Carbon::now(); // Get current date and time using Carbon
    $currentYear = Carbon::now()->year;  
    // Get the start and end of the current quarter
    $startOfQuarter = $now->copy()->firstOfQuarter();
    $endOfQuarter = $now->copy()->lastOfQuarter();

    // Get the office name (you can customize this part based on your logic)
   
    // Get survey responses for the current quarter using whereBetween()
    $responses = survey_responses::whereBetween('created_at', [$startOfQuarter, $endOfQuarter])
    ->whereYear('created_at', $currentYear)    
    ->get();

    // Count the total responses, positive and negative sentiments
    $total_responses = $responses->count();



    return view('AdminView.AdminSurveyAnalytics',compact('total_responses'));
})->name('survey_analytics');


Route::post('chat','App\Http\Controllers\ChatController');
Route::get('chat_view', function(){
return view('chatbot');
});
Route::get('/test-api', [ChatController::class, 'testApiConnection']);
Route::get('/get-quarter-data', [SurveyAnalyticsController::class, 'getData']);

Route::get('/view-transaction-counts', [TransactionCountController::class, 'index'])->name('viewTransactionCount');
Route::get('/transaction-status/{main_id}', [TransactionCountController::class, 'getTransactionStatus']);
Route::get('/api/ranked-services/{subOffice}', [SectionController::class, 'getRankedSectionServices']);
Route::get('logout',[LogoutController::class,'logout']);


Route::get('/accounts/activation-status', [AccountController::class, 'showActivationStatus'])->name('account_list');
Route::delete('/accounts/reset/{type}/{id}', [AccountController::class, 'resetActivation'])->name('account_reset');

Route::get('api/recent-activities', [App\Http\Controllers\RequestController::class, 'getRecentActivity']);

// Route for getting all dashboard data including recent activities
 Route::get('/HomeSDOPage',function(){
    return view ('HomeSDOPage');
 })->name('landing_page');
  Route::get('/HomePage',function(){
    return view ('HomePage');
 })->name('HomePage');  Route::get('/SDO-SCC-Assistant',function(){
    return view ('SDO_chatbot');
 })->name('SDO-SCC-Assistant');
 Route::get('/top-sqd',function(){
    return view ('AdminView.AdminSQDTop');
    
 }); 
 // Historical sentiment data endpoints,
 Route::get('/sentiments-data/historical/positive', [AdminViewController::class,  'getHistoricalPositive']);
 Route::get('/sentiments-data/historical/negative',  [AdminViewController::class, 'getHistoricalNegative']);
 Route::get('/sentiments-data/historical/neutral',  [AdminViewController::class, 'getHistoricalNeutral']);
 Route::get('/sentiments-data/historical/all',  [AdminViewController::class, 'getHistoricalAll']);
 
 // New comprehensive endpoint for all feedback data
    Route::get('/sentiments-data/all-feedback',  [AdminViewController::class,'getAllFeedback']);

 Route::get('/Office-Performance',function(){
    return view ('OfficeView.OfficeQuarterlyPerformance');
    
 })->name('OfficePerformance'); 

 Route::get('/Admin/Recent-Activities', [AdminViewController::class, 'logs'])->name('recent_activities');

    Route::get('Section/Profile',[SectionController::class,'profile']);
   Route::post('section/profile/upload', [SectionController::class, 'upload'])->name('section.profile.upload');


 