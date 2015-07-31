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

Route::Controllers(array(
    'auth' =>   'Auth\AuthController',
    'password' => 'Auth\PasswordController'
));
Route::get('/', function(){
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
Route::get('/forgotpassword', function(){
    return view('auth/password');
});
Route::get('account/verify', function(){
    return view('account_verify');
});
Route::get('account/verified', function(){
    return view('account_verified');
});
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::get('/account/verify/{code}', 'Auth\AuthController@activateAccount');
Route::get('/rest/password/{token}' , 'Auth\PasswordController@getReset');
Route::post('/change/password', 'ProfileController@changePassword');
Route::get('/members', 'SearchController@getAllUsers');
Route::get('/search', 'SearchController@getSearchData');
Route::get('/organization/{id}', 'OrgController@getProfile');
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
});