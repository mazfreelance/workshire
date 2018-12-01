<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/ 
//LOGIN,RESET,REGISTER [JOB SEEKER]
Auth::routes(); 
Route::group(['namespace' => 'Auth'], function() { 
    Route::post('login', 'LoginController@login')->name('login.submit'); 

    //social media login
    Route::get('/login/{social}','LoginController@socialLogin')
            ->where('social','twitter|facebook|linkedin|google')
            ->name('loginsocial');
    Route::get('/login/{social}/callback','LoginController@handleProviderCallback')
            ->where('social','twitter|facebook|linkedin|google'); 
    
    //verify user
    Route::get('/user/verify/{token}', 'RegisterController@verifyUser');

    //logout 
    Route::post('user/logout', 'LoginController@userLogout')->name('user.logout');
});
//LOGIN,RESET,REGISTER [EMPLOYER]
Route::group(['as' => 'employer.', 'prefix' => 'employer', 'namespace' => 'AuthEmployer'], function() { 
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@EmployerLogin')->name('login.submit');
    Route::post('logout', 'LoginController@employerLogout')->name('logout');

    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register.submit');

    //verify user
    Route::get('verify/{token}', 'RegisterController@verifyUser')->name('verify');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});
//LOGIN,RESET [ADMIN]
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'AuthAdmin'], function(){  
    Route::get('login', 'LoginController@showLoginForm')->name('login'); 
    Route::post('login', 'LoginController@login')->name('login.submit');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    //Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    //Route::post('/password/reset', 'ResetPasswordController@reset'); 
}); 

 
/* JOB SEEKER */    
// JOB POST LIST 
Route::group(['namespace' => 'Seeker'], function() {
    Route::get('/', 'jobPostController@index')->name('main'); 
    Route::get('ViewJob/{name}/{id}', 'jobPostController@view')->name('view.job'); 
    Route::get('show/{id}', 'jobPostController@show'); 
    Route::get('saveJOB', 'jobPostController@saveJOB')->name('save_job');
    Route::get('unsaveJOB', 'jobPostController@unsaveJOB')->name('unsave_job');
}); 

//middleware seeker
Route::group(['as' => 'seeker.', 'prefix' => 'seeker', 'namespace' => 'Seeker', 'middleware' => 'auth:web'], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('save-job', 'DashboardController@save_job')->name('savejob');
    Route::post('process_apply', 'DashboardController@apply')->name('process_apply'); 

    //message
    Route::get('message', 'MessageController@index')->name('message'); 

    //profile
    Route::get('profile', 'ProfileController@index')->name('profile'); 
    Route::get('profile/education-experience', 'ProfileController@showEduExp')->name('showEduExp'); 
    Route::get('profile/message', 'ProfileController@showMessage')->name('showMessage'); 
    Route::get('profile/edit', 'ProfileController@showEditForm')->name('showEditForm'); 
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');  
    Route::get('profile/resume/{id}', 'ProfileController@resume')->name('resume');  
    //Routes which needs to check if profile is complete or not 
    Route::get('complete/profile', 'ProfileController@complete')->name('account.complete');  
    Route::post('complete/profile/post', 'ProfileController@complete_post')->name('account.complete.post'); 

    //setting 
    Route::get('setting', 'SettingController@showAccount')->name('setting');  
    Route::post('setting/upd/acc', 'SettingController@updateAcc')->name('updateAcc'); 
    Route::get('setting/password', 'SettingController@showPassword')->name('setting.password'); 
    Route::post('setting/upd/pass', 'SettingController@updatePass')->name('updatePass');  
    Route::get('setting/notification', 'SettingController@notification')->name('setting.notification'); 
    Route::post('setting/notification/edit', 'SettingController@notification_post')->name('setting.notification.edit');  
});  


/* EMPLOYER */  
//middleware employer
Route::group(['as' => 'employer.', 'prefix' => 'employer', 'namespace' => 'Employer', 'middleware' => 'auth:employer'], function(){ 
    //jobpost
    Route::get('/', 'DashboardController@index')->name('dashboard'); 
    Route::get('post', 'DashboardController@post_job')->name('postjob');  
    Route::match(['get', 'post'], 'create', 'DashboardController@create_job')->name('createPost');
    Route::match(['get', 'put'], 'update/{id}', 'DashboardController@update_job')->name('update'); 
    Route::delete('delete/{id}', 'DashboardController@destroy');
    Route::get('show/{id}', 'DashboardController@show_post');

    //Routes which needs to check if profile is complete or not 
    Route::get('complete/profile', 'ProfileController@complete')->name('account.complete');  

    //candidate
    Route::get('candidate-fresh', 'CandidateController@candidate_search_fresh')->name('candidate.fresh'); 
    Route::get('candidate-exp', 'CandidateController@candidate_search_experience')->name('candidate.experience'); 
    Route::get('candidate-intern', 'CandidateController@candidate_search_intern')->name('candidate.intern'); 
    Route::get('candidate-operator', 'CandidateController@candidate_search_operator')->name('candidate.operator'); 
    Route::get('buy_candidate', 'CandidateController@buy_candidate'); 
    Route::get('paid-candidate', 'CandidateController@paid')->name('paid'); 

    //applicant
    Route::match(['get', 'put'],'applicant/{name}/{id}', 'ApplicantController@applicant')->name('applicant'); 
    Route::get('applicant/profile/seeker/{id}', 'ApplicantController@seeker_profile'); 
    Route::get('status_applicant/{id}', 'ApplicantController@applicant_status'); 

    //profile
    Route::get('profile', 'ProfileController@index')->name('profile'); 

    //setting
    Route::get('setting', 'SettingController@index')->name('setting'); 
    Route::post('setting/upd/acc', 'SettingController@updateAcc')->name('updateAcc'); 
    Route::get('setting/password', 'SettingController@password')->name('setting.password'); 
    Route::post('setting/upd/pass', 'SettingController@updatePass')->name('updatePass');  
    Route::get('setting/notification', 'SettingController@notification')->name('setting.notification'); 
    Route::post('setting/notification/edit', 'SettingController@notification_post')->name('setting.notification.edit');  
    Route::get('setting/plan', 'SettingController@plan')->name('setting.plan'); 

    //cart 
    Route::get('checkout', 'CheckoutController@index')->name('checkout'); 
    Route::post('formvalidate', 'CheckoutController@checkout_post')->name('checkout.post');

    //message 
    Route::get('message', 'MessageController@message')->name('message'); 
});
Route::group(['as' => 'employer.', 'prefix' => 'employer', 'middleware' => 'auth:employer'], function(){  
    //invoice  
    Route::get('invoice', 'DocumentController@list_invoice')->name('invoice');
    Route::get('invoice/{date}', 'DocumentController@invoice'); 
    Route::get('thankyou', function() { return view('employer.cart.thankyou'); }); 
});
//not middleware employer 
Route::group(['as' => 'employer.', 'prefix' => 'employer'], function() { 
    Route::get('home', function(){ return view('employer.main'); })->name('main');

    //cart
    Route::get('pricing', 'HomeController@pricePLAN')->name('pricing');
    Route::get('cart/addItem/{id}', 'Employer\CartController@addItem');
    Route::get('cart/update', 'Employer\CartController@update')->name('update');
    Route::get('cart/remove/{id}', 'Employer\CartController@destroy');
    Route::get('cart', 'Employer\CartController@index')->name('cart');
}); 

/* ADMINISTRATOR */  
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth:admin', 'namespace' => 'Admin'], function(){  
    Route::get('/', 'DashboardController@index')->name('dashboard'); 
    Route::get('setting/search-candidate', 'SettingController@search_candidate')->name('search_candidate'); 
    Route::get('setting/candidate-expired', 'SettingController@candidate_expired')->name('candidate_expired'); 
    Route::get('setting/mail', 'SettingController@mail')->name('mail'); 
    Route::get('setting/web', 'SettingController@web')->name('web');  
    Route::get('setting/package', 'SettingController@package')->name('package'); 
    Route::get('setting/package/employer', 'SettingController@package_employer')->name('package_employer'); 
    Route::get('setting/package/topup/add', 'SettingController@package_add')->name('package_add'); 
    Route::get('setting/package/topup/reload', 'SettingController@package_reload')->name('package_reload');  
}); 

/* CONTACT */  
Route::group(['prefix' => 'contact'], function(){
    Route::get('about', function(){ return view('our_wh.about'); })->name('about_us');
    Route::get('PDP', function(){ return view('our_wh.pdp'); })->name('data_policy');
    Route::get('Policy', function(){ return view('our_wh.pp'); })->name('privacy');
    Route::get('Terms&Cond', function(){ return view('our_wh.t&c'); })->name('term&conds');
});

/* GLOBAL USE */
Route::get('public/document/uploadsCV/{id}', 'DocumentController@getDocument');
Route::get('profile/print/{id}', 'DocumentController@print');
Route::get('poskod', 'HomeController@poskod')->name('poskod');
Route::get('jobfair', 'HomeController@jobfairForm')->name('jobfairForm');
Route::post('jobfair_post', 'HomeController@jobfair')->name('jobfair');
    





























/**
TUTORIAL ROUTE
**/

/*
Route::group(['as' => 'employer.', 'prefix' => 'employer', 'namespace' => 'Employer', 'middleware' => ['auth', 'employer']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard'); 
    Route::get('jobposted', function (){ return view('employer.jobposted'); })->name('jobposted'); 
}); 

Route::group(['prefix' => 'search-job'], function() {
    Route::get('/', 'jobPostController@index')->name('seeker.main'); 
}); 

Route::get('/employer/job-posted', function () {
    return view('employer.jobposted');
}); 
Route::get('/employer/applicant', function () {
    return view('employer.applicant');
});
Route::get('/employer/invite', function () { return view('employer.invite'); });
Route::get('/employer/post-job', function () { return view('employer.postjob'); });
Route::get('/employer/search-candidate', function () {  return view('employer.candidate');});
*/ 


Route::get('/live_search', 'LivesearchController@index');
Route::get('/live_search/action', 'LivesearchController@action')->name('live_search.action');

Route::group(['prefix' => 'posts'], function() {
  Route::get('/', 'PostController@index');
  Route::match(['get', 'post'], 'create', 'PostController@create');
  Route::match(['get', 'put'], 'update/{id}', 'PostController@update');
  Route::get('show/{id}', 'PostController@show');
  Route::delete('delete/{id}', 'PostController@destroy');
});

Route::get('sendmail', function() { 
    \Mail::to($mail)->send(new JobAppliedNoti('JOB POSITION'));
    dd('mail sent');
});
Route::get('test', function() {return view('emails.applyjobnoti'); }); 
Route::get('jobalert', function() { 
    $totaljobs = \DB::table('job_postings')
                  ->whereRaw('jobpost_status = "A"') 
                  ->count();

    $totalUsers = \DB::table('users') 
                      ->select('*', 'users.id', 'job_seekers.id as seeker_id', 'notification_seeker.id as noti_id')
                      ->join('job_seekers', 'users.id', '=', 'job_seekers.users_id')
                      ->join('notification_seeker', 'users.id', '=', 'notification_seeker.user_id')
                      ->whereRaw('notification_seeker.job_alert = "Y|Daily"')
                      ->get();  
    $seek = App\Model\job_seeker::where('users_id', '=', 2)->first();
 
    /* preferences check
    $totalUsers = \DB::table('users') 
              ->select('*', 'users.id', 'job_seekers.id as seeker_id', 'notification_seeker.id as noti_id')
              ->join('job_seekers', 'users.id', '=', 'job_seekers.users_id')
              ->join('notification_seeker', 'users.id', '=', 'notification_seeker.user_id')
              ->whereRaw('notification_seeker.job_alert = "Y|Daily"')
              ->whereRaw('notification_seeker.user_id = 2')
              ->get();  
    $array = array(); 
    foreach ($totalUsers as $user)
    {    
        $keyword = isset($user->preferences_keyword) ? $user->preferences_keyword : '';
        $location = isset($user->preferences_location) ? $user->preferences_location : '';
        $category = isset($user->preferences_category) ? $user->preferences_category : '';
         
        $jobs = \DB::table('job_postings')  
               ->whereRaw('jobpost_status = "A" AND (jobpost_loc_state LIKE "%'.$location.'%" OR jobpost_position LIKE "%'.$keyword.'%" OR jobpost_field_study LIKE "%'.$category.'%")')
               ->get();
        
    }
    echo $jobs->count() > 0 ?  'yes':'no';*/

    // \Log::info($seek);

    return $totalUsers;
});
Route::get('email', function() {return view('emails.jobalert'); }); 