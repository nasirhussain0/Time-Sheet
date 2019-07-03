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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/updateUser', 'UserController@index')->name('updateUser');
Route::post('updateProfile/{id}', 'UserController@updateProfile')->name('updateProfile');
Route::post('updatePassword/{id}', 'UserController@updatePassword')->name('updatePassword');
Route::post('removeUser/{id}', 'UserController@removeUser')->name('removeUser');

//admin routes
Route::group(['middleware' => ['restrictToAdmin']], function(){
	// users routes
	Route::get('getAllUsers','Admin\AdminController@index')->name('getAllUsers');
	Route::get('getUser/{id}', 'Admin\AdminController@getUser')->name('getUser');
	Route::post('updateUserProfile/{id}', 'Admin\AdminController@updateUserProfile')->name('updateUserProfile');
	// Route::get('deleteUser/{id}', 'Admin\AdminController@deleteUser')->name('deleteUser');

	Route::get('accountFreeze/{id}', 'Admin\AdminController@accountFreeze')->name('accountFreeze');
	Route::get('unfreeze/{id}', 'Admin\AdminController@unfreeze')->name('unfreeze');

	Route::get('/getAllExpenses', 'Admin\AdminController@getAllExpenses')->name('getAllExpenses');
	
	Route::get('approveExpense/{expenses_id}', 'Admin\AdminController@approveExpense')->name('approveExpense');
	Route::get('declineExpense/{expenses_id}', 'Admin\AdminController@declineExpense')->name('declineExpense');

	Route::get('/getAllSessions', 'Admin\AdminController@getAllSessions')->name('getAllSessions');
	Route::get('approveSession/{session_id}', 'Admin\AdminController@approveSession')->name('approveSession');
	Route::get('declineSession/{session_id}', 'Admin\AdminController@declineSession')->name('declineSession');
	
	Route::get('getUsersTimesheets', 'Admin\AdminController@getUsersTimesheets')->name('getUsersTimesheets');

	Route::get('generatepdf', 'Admin\AdminController@generatePDF')->name('generatePDF');
	Route::get('generatecsv', 'Admin\AdminController@generatecsv')->name('generatecsv');
	Route::get('getreport', 'Admin\AdminController@getreport')->name('getreport');
	Route::get('getReportByDates', 'Admin\AdminController@getReportByDates')->name('getReportByDates');



//job routes
	Route::get('newJob', 'JobController@newJob')->name('newJob');
	Route::post('/createNewJob', 'JobController@createNewJob');

	Route::get('getAllJobs','JobController@index')->name('getAllJobs');
	Route::get('getJob/{id}', 'JobController@getJob')->name('getJob');
	Route::post('updateJob/{id}', 'JobController@updateJob')->name('updateJob');
	// Route::get('deleteJob/{id}', 'JobController@deleteJob')->name('deleteJob');



});



Route::get('/newSession', 'SessionController@newSession')->name('newSession');
Route::post('/createNewSession', 'SessionController@createNewSession');
Route::get('/getSessions', 'SessionController@getSessions')->name('getSessions');
Route::get('/getSession/{session_id}', 'SessionController@getSession')->name('getSession');
Route::post('/updateSession/{session_id}', 'SessionController@updateSession');


//Expense url
Route::get('/newExpense', 'ExpenseController@newExpense')->name('newExpense');
Route::post('/createNewExpense', 'ExpenseController@createNewExpense');

Route::get('/getExpenses', 'ExpenseController@getExpenses')->name('getExpenses');

Route::get('/getExpense/{expenses_id}', 'ExpenseController@getExpense')->name('getExpense');
Route::post('/updateExpense/{expenses_id}', 'ExpenseController@updateExpense');

Route::get('/getExpensePicture/{expenses_id}', 'ExpenseController@getExpensePicture')->name('getExpensePicture');
Route::post('/updateExpensePicture/{expenses_id}', 'ExpenseController@updateExpensePicture');

Route::get('deleteExpense/{expenses_id}', 'ExpenseController@deleteExpense')->name('deleteExpense');





