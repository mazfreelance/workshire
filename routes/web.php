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
    Route::get('/user/verify/{token}', 'RegisterController@verifyUser')->name('verify_user');

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

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');

    //verify user
    Route::get('verify/{token}', 'RegisterController@verifyUser')->name('verify');
}); 
/* JOB SEEKER */      
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
    Route::post('complete/profile/upload', 'ProfileController@upload_photo')->name('upload_photo'); 
    Route::post('complete/profile/upload_resume', 'ProfileController@upload_resume')->name('upload_resume'); 

    Route::match(['get', 'post'], 'create-education', 'ProfileController@create_edu')->name('create_edu');
    Route::match(['get', 'put'], 'update-education/{id}', 'ProfileController@update_edu')->name('update_edu');
    Route::get('delete-education/{id}', 'ProfileController@delete_edu')->name('delete_edu'); 

    Route::match(['get', 'post'], 'create-experience', 'ProfileController@create_exp')->name('create_exp');
    Route::match(['get', 'put'], 'update-experience/{id}', 'ProfileController@update_exp')->name('update_exp');
    Route::get('delete-experience/{id}', 'ProfileController@delete_exp')->name('delete_exp'); 

    Route::get('complete/verify/{id}', 'ProfileController@verify_complete')->name('account.verify.complete');

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
 

    //candidate
    Route::get('candidate-fresh', 'CandidateController@candidate_search_fresh')->name('candidate.fresh'); 
    Route::get('candidate-exp', 'CandidateController@candidate_search_experience')->name('candidate.experience'); 
    Route::get('candidate-intern', 'CandidateController@candidate_search_intern')->name('candidate.intern'); 
    Route::get('candidate-operator', 'CandidateController@candidate_search_operator')->name('candidate.operator'); 
    Route::get('buy_candidate', 'CandidateController@buy_candidate'); 
    Route::get('paid-candidate', 'CandidateController@paid')->name('paid');
    Route::get('seeker/profile/{id}', 'CandidateController@seeker_profile')->name('seekerProf');


    //applicant
    Route::match(['get', 'put'],'applicant/{name}/{id}', 'ApplicantController@applicant')->name('applicant'); 
    Route::get('applicant/profile/seeker/{id}', 'ApplicantController@seeker_profile')->name('applicant'); 
    Route::get('status_applicant/{id}', 'ApplicantController@applicant_status'); 

    //profile
    Route::get('profile', 'ProfileController@index')->name('profile'); 
    //Routes which needs to check if profile is complete or not 
    Route::get('complete/profile', 'ProfileController@complete')->name('account.complete'); 
    Route::post('profile/post', 'ProfileController@create')->name('profile_post'); 
    Route::post('complete/profile/upload', 'ProfileController@upload_photo')->name('upload_photo'); 
    Route::get('complete/verify/{id}', 'ProfileController@verify_complete')->name('account.verify.complete');

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



//LOGIN,RESET [ADMIN]
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'AuthAdmin'], function(){  
    Route::get('login', 'LoginController@showLoginForm')->name('login'); 
    Route::post('login', 'LoginController@login')->name('login.submit');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset'); 
}); 
/* ADMINISTRATOR */  
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth:admin', 'namespace' => 'Admin'], function(){  
    Route::get('dashboard', 'DashboardController@index')->name('dashboard'); 
    Route::get('numbers', 'DashboardController@numbers')->name('numbers'); 

    Route::get('setting/search-candidate', 'SettingController@search_candidate')->name('search_candidate'); 
    Route::post('setting/post-search-candidate', 'SettingController@post_search_candidate')->name('post_search_candidate');  

    Route::get('setting/candidate-expired', 'SettingController@candidate_expired')->name('candidate_expired'); 
    Route::match(['get', 'put'], 'update-candidate-expired/{id}', 'SettingController@update_candidate_expired')->name('update_candidate_expired');

    //package and cart
    Route::get('setting/package', 'SettingController@package')->name('package'); 
    Route::match(['get', 'post'], 'create-package', 'SettingController@create_package')->name('create_package');
    Route::match(['get', 'put'], 'update-package/{id}', 'SettingController@update_package')->name('update_package');
    Route::get('destroy-package/{id}', 'SettingController@destroy_package')->name('destroy_package');  
 
    Route::match(['get', 'post'], 'create-jobpostingduration', 'SettingController@create_jobpostingduration')->name('create_jobpostingduration');
    Route::match(['get', 'put'], 'update-jobpostingduration/{id}', 'SettingController@update_jobpostingduration')->name('update_jobpostingduration');
    Route::get('destroy-jobpostingduration/{id}', 'SettingController@destroy_jobpostingduration')->name('destroy_jobpostingduration'); 

    Route::get('setting/cart-package', 'SettingController@cart_package')->name('cart_package'); 
    Route::match(['get', 'post'], 'create-cart_package', 'SettingController@create_cart_package')->name('create_cart_package');
    Route::match(['get', 'put'], 'update-cart_package/{id}', 'SettingController@update_cart_package')->name('update_cart_package');
    Route::get('destroy-cart_package/{id}', 'SettingController@destroy_cart_package')->name('destroy_cart_package'); 


    Route::get('setting/orders', 'SettingController@orders')->name('orders'); 
    Route::match(['get', 'put'], 'update-orders/{id}', 'SettingController@update_orders')->name('update_orders');
    Route::match(['get', 'put'], 'add-token-cart/{emp_id}/{post_id}/{resume_id}', 'SettingController@add_token_cart')->name('add_token_cart');
    Route::get('setting/token-manual', 'SettingController@addtokenmanual')->name('addtokenmanual'); 
    Route::match(['get', 'put'], 'add-token-manual/{emp_id}/{post_id}/{resume_id}', 'SettingController@add_token_manual')->name('add_token_manual');

    Route::get('setting/jobapproval', 'SettingController@jobapproval')->name('jobapproval'); 
    Route::match(['get', 'put'], 'update-jobposting/{id}', 'SettingController@update_jobposting')->name('update_jobposting');
    Route::match(['get', 'put'], 'update-jobapproval/{id}', 'SettingController@update_jobapproval')->name('update_jobapproval');
  
    //USER AND EMAIL
    Route::get('setting/mail', 'SettingController@mail')->name('mail'); 
    Route::get('setting/web', 'SettingController@web')->name('web');  
    Route::match(['get', 'post'], 'post', 'SettingController@add_email')->name('post');
    Route::match(['get', 'put'], 'update/{id}', 'SettingController@update_email')->name('update_email');
    Route::get('delete_email/{id}', 'SettingController@destroy_email')->name('delete_email');  

    Route::get('setting/user', 'SettingController@user')->name('user'); 
    Route::match(['get', 'post'], 'user/create', 'SettingController@create_user')->name('create_user');
    Route::match(['get', 'put'], 'user/update/{id}', 'SettingController@update_user')->name('update_user');
    Route::get('user/delete_user/{id}', 'SettingController@destroy_user')->name('delete_user');  

    Route::get('setting/demo-data', 'DashboardController@demodata')->name('demodata'); 
    Route::get('setting/advance-search', 'DashboardController@advancesearch')->name('advancesearch');
    Route::post('setting/post-advance-search', 'DashboardController@postadvancesearch')->name('postadvancesearch');  
    
}); 

/* CONTACT */  
Route::group(['prefix' => 'contact'], function(){
    Route::get('about', function(){ return view('our_wh.about'); })->name('about_us');
    Route::get('PDP', function(){ return view('our_wh.pdp'); })->name('data_policy');
    Route::get('Policy', function(){ return view('our_wh.pp'); })->name('privacy');
    Route::get('Terms&Cond', function(){ return view('our_wh.t&c'); })->name('term&conds');
});

/* GLOBAL USE */
Route::get('public/document/uploadsCV/{id}', 'DocumentController@getDocument')->name('resume');
Route::get('profile/print/{id}', 'DocumentController@print');
Route::get('poskod', 'HomeController@poskod')->name('poskod');
Route::get('cart_pro', 'HomeController@cart_pro')->name('cart_pro');
Route::get('pck_plan_jpost', 'HomeController@pck_plan_jpost')->name('pck_plan_jpost');
Route::get('pck_plan_resume', 'HomeController@pck_plan_resume')->name('pck_plan_resume');
Route::get('jobfair', 'HomeController@jobfairForm')->name('jobfairForm');
Route::post('jobfair_post', 'HomeController@jobfair')->name('jobfair');
Route::get('operator', 'HomeController@operatorForm')->name('operatorForm');
Route::post('operator_post', 'HomeController@operator')->name('operator');




//view routes
Route::get('route', function() {
    $routeCollection = \Route::getRoutes();
    echo "<table style='width:100%'>";
        echo "<tr>";
            echo "<td width='10%'><h4>HTTP Method</h4></td>";
            echo "<td width='10%'><h4>Route</h4></td>";
            echo "<td width='10%'><h4>Name</h4></td>";
            echo "<td width='70%'><h4>Corresponding Action</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
                echo "<td>" . $value->methods()[0] . "</td>";
                echo "<td>" . $value->uri() . "</td>";
                echo "<td>" . $value->getName() . "</td>";
                echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
    echo "</table>";
});

    





























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



Route::get('email', function() {return view('emails.jobalert'); });
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
    // \Log::info($seek); 
    return $totalUsers;
}); 
 

Route::get('emailview', function () {
    return view('emails.alerttoemployerforpackage');
});

Route::get('test', function () {  

        $monday = \Carbon::now()->startOfWeek(); 
        $sunday = \Carbon::now()->endOfWeek(); 
    $jobs = \DB::table('job_postings')  
                   ->whereRaw('jobpost_status = "A"')
                   ->whereRaw('Date(jobpost_startDate) BETWEEN Date("2018-12-03") AND Date("2018-12-07")')
                   ->get();

    return dd($jobs);
});
*/
