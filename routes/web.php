<?php

use Illuminate\Support\Facades\Route;

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

Route::group(["middleware"=>"logdb"], function() {

    Route::get('/', function () {
        return view('index');
    });

    route::get('home', function() {
        return view('welcome');
    });

    // route::get('admin', function() {
    //     return view('admin/admin_dashboard');
    // });
    route::get('admin/getnoti','AdminController@menuNoti');
    route::get('admin','AdminController@dashboard')->middleware("auth-admin");

    // route::get('admin/usersPF', function() {
    //     return view('admin/admin_usersprofile');
    // });

    route::get('admin/usersAP','AdminController@userAprove');
    route::post('admin/approveuser', "AdminController@approveuser");
    route::post('admin/rejectuser', "AdminController@rejectuser");
    route::post('admin/viewDoc', "AdminController@viewDoc");
    // route::get('admin/usersAP', function() {
//     return view('admin/admin_usersapprove');
// });

    route::get('admin/forumRP','AdminController@forumReport');
    route::post('admin/dismissreport', "AdminController@dismissreport");
    route::post('admin/deletereport', "AdminController@deletereport");
// route::get('admin/forumRP', function() {
//     return view('admin/admin_forumreport');
// });

    Route::get('/testAuth', [
        'middleware' => ['auth'],
        'uses' => function () {
            echo "You are allowed to view this page!";
        }]);

    Route::get('register', function() {
        return view('register/register');
    });
    Route::get('api/province','LocationController@provinces');
    Route::get('api/province/{province_code}/amphoe','LocationController@amphoes');
    Route::get('api/province/{province_code}/amphoe/{amphoe_code}/district','LocationController@districts');
    Route::get('api/province/{province_code}/amphoe/{amphoe_code}/district/{district_code}','LocationController@detail');

    Route::post('regishotel', "RegisterController@hotelRegister");

    Route::post('regisagent', "RegisterController@agentRegister");
//Route::post('/login', function() {
//    return 'Hello World';
//});

    Route::get('/district', function () {
        return view("district/index");
    });

    route::get('viewProfileH', function() {
        return view('viewProfileH');
    });

    route::get('viewProfileH-test', function() {
        return view('viewProfileH-test');
    });

    route::get('viewProfileA', function() {
        return view('viewProfileA');
    });

    route::get('viewProfileA-test', function() {
        return view('viewProfileA-test');
    });

    route::get('registertest', function() {
        return view('register/register-test');
    });
    
    route::get('viewProfile','ProfileController@viewMyProfile');
    route::get('getAsset','ProfileController@getAsset');
    route::get('getAsset/{assetId}','ProfileController@getAssetById')->where('assetId', '\d+');
    route::get('profile/{id?}','ProfileController@viewProfile');

    route::get('contactus','ContactusController@viewMyProfile');

    route::get('editProfile','ProfileController@editProfile');
    Route::post('/updateProfile','ProfileController@updateProfile');

    
    Route::post('/report','ReportController@report');
// ----------------------------------- test ---------------------------------
    Route::get('/test/{id?}', function ($id=null) {  //id? is mean you can either input id or not (if not it would be null)
        $Fname = 'Aerith';
        $Lname = 'Gainbough';
        return view('test', compact('Fname', 'Lname','id'));
    });

    Route::post('/landing', "LandingPageController@index")->middleware('auth');
    Route::get('/landing', "LandingPageController@index");

    Route::get('/agent/post', function() {
        return view('agent.post');
    });
    Route::post('/agent/post/submit', "AgentPostController@submit");

    Route::get('/reply/hotel/{id}', "HotelReplyController@index")->where('id', '\d+');
    Route::post('/reply/hotel', "HotelReplyController@reply");
    Route::get('/reply/agent/{id}', "AgentReplyController@index")->where('id', '\d+');
    Route::post('/reply/agent', "AgentReplyController@reply");

//    Route::post('/reply/agent/{id}/deal', "AgentReplyController@deal")->where('id', '\d+');
    Route::post('/reply/agent/deal', "AgentReplyController@deal");


    Route::get('/quotation', "QuotationController@prepare");
    Route::post('/quotation', "QuotationController@submit");

    Route::get('/quotation/preview', "QuotationController@quotationPreview");
    Route::post('/quotation/preview', "QuotationController@quotationPreviewSubmit");

    Route::get('/testmail', "MailController@html_email");


    Route::get('/reset/request', function () {
        return view('reset.criteria');
    });
    Route::post("/reset/request", "ResetPasswordController@sendMail");
    Route::get('/reset/request/{token}', function ($token) {
        return view('reset.newpass')->with("reset_token", $token);
    });
    Route::post("/reset/new", "ResetPasswordController@requestForReset");

    Route::get('/logout', function() {
        session()->flush();
        return redirect("/");
    });

    Route::post('/sendDirectContact', "MailController@sendFeedback");
});
