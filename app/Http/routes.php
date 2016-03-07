<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::Controllers(array('auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController'));
//Route::get('test', 'ProfileController@hashPassword');
Route::get('/', function () {
    return view('index');
});
Route::get('/home', function () {
    return view('index');
});
Route::get('/addmember', function () {
    return view('add_member');
});
Route::get('register/organization', function () {
    return view('add_org');
});
Route::get('/forgotpassword', function () {
    return view('auth/password');
});
Route::get('/account/activation', function () {
    return view('account_activation');
});
Route::post('/activate/account', 'ProfileController@activateAccount');
Route::get('account/verify', function () {
    return view('account_verify');
});
Route::get('account/verified', function () {
    return view('account_verified');
});
Route::get('about', function () {
    return view('about_us');
});
Route::get('FAQ', function () {
    return view('FAQ');
});
Route::get('contact', function () {
    return view('contact_us');
});
Route::post('/contact', 'ContactUsController@sendMail');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::get('/account/verify/{code}', 'Auth\AuthController@activateAccount');
Route::get('/rest/password/{token}', 'Auth\PasswordController@getReset');
Route::post('/change/password', 'ProfileController@changePassword');
Route::get('/members', 'SearchController@getAllUsers');
Route::get('/search', 'SearchController@getSearchData');
Route::get('/organization/{id}', 'OrgController@getProfile');
Route::get('/helplines', 'HelplinesController@index');
Route::post('/helplines', 'HelplinesController@filterData');
Route::group(['middleware' => 'auth'], function () {
    Route::post('/organization/join', 'OrgRequestsController@store');
    Route::get('/organizations', 'OrgController@index');
    Route::get('/create/organization', 'OrgController@create');
    Route::post('/create/organization', 'OrgController@store');
    Route::post('/organization/update', 'OrgController@update');
    Route::post('/organization/addmember', 'OrgController@addMember');
    Route::post('/organization/change/admin', 'OrgController@changeAdmin');
    Route::get('/delete/user/{id}', 'OrgController@deleteMember');
    Route::get('/organization/request/accept/{id}', 'OrgController@acceptRequest');
    Route::get('/organization/request/reject/{id}', 'OrgController@rejectRequest');
    Route::get('/profile/{username}', 'ProfileController@getProfile');
    Route::post('/profile/update', 'ProfileController@updateProfile');
    Route::post('/bleed/update', 'BleedController@update');
    Route::post('/delete/user', 'ProfileController@deleteUser');
    Route::post('/delete/organization', 'OrgController@delete');
});
Route::get('/report/user', 'ReportsController@index');
Route::post('/report/user', 'ReportsController@reportUser');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'admin'], function () {
    Route::get('/login', 'MainController@login');
    Route::post('/login', 'MainController@login');
    Route::get('/', 'MainController@index');
    Route::get('/dashboard', 'MainController@index');
    Route::get('/users', 'UserController@getAll');
    Route::get('/deleted/users', 'UserController@getDeleted');
    Route::post('/deleted/users', 'UserController@filter');
    Route::post('/users', 'UserController@filter');
    Route::get('/user/{id}', 'UserController@getUser');
    Route::get('/add/user', function () {
        return view('admin.add_user');
    });
    Route::post('/add/user', 'UserController@add');
    Route::get('/edit/user/{id}', 'UserController@edit');
    Route::post('/edit/user', 'UserController@update');
    Route::get('/delete/user/{id}', 'UserController@delete');
    Route::get('/delete/reported/user/{id}', 'ReportsController@deleteReportedUser');
    Route::get('/undo/delete/user/{id}', 'UserController@undoDelete');
    Route::get('/change/user/status/{id}', 'UserController@changeStatus');
    Route::get('/user/{id}/bleed/history', 'BleedController@getAll');
    Route::get('/user/{user_id}/edit/bleed/{bleed_id}', 'BleedController@edit');
    Route::post('/user/edit/bleed', 'BleedController@update');
    Route::get('/add/user/{id}/bleed', 'BleedController@index');
    Route::post('/add/user/bleed', 'BleedController@add');
    Route::get('/organizations', 'OrgController@getAll');
    Route::post('/organizations', 'OrgController@filter');
    Route::get('/organization/{id}', 'OrgController@getOrg');
    Route::get('/add/organization', function () {
        return view('admin.add_org');
    });
    Route::post('/add/organization', 'OrgController@add');
    Route::get('/delete/organization/{id}', 'OrgController@delete');
    Route::get('/edit/organization/{id}', 'OrgController@editOrg');
    Route::post('/edit/organization', 'OrgController@update');
    Route::get('/change/organization/status/{id}', 'OrgController@changeStatus');
    Route::get('/reports', 'ReportsController@getAll');
});
Route::get('/fblogin', function () {
    return Socialite::with('facebook')->redirect();
});
Route::get('/fbAuth', 'Auth\AuthController@fbLoginCallback');
Route::post('/fbAuth', 'Auth\AuthController@postFbLogin');
Route::get('/gplogin', function () {
    return Socialite::with('google')->redirect();
});
Route::get('/gpAuth', 'Auth\AuthController@gpLoginCallback');
Route::post('/gpAuth', 'Auth\AuthController@postGpLogin');
Route::get('/getCities/{country_id}', 'SearchController@getCities');
Route::get('/linkAccount/{type}', 'ProfileController@linkAccount');
Route::get('/unlinkAccount/{type}', 'ProfileController@unlinkAccount');