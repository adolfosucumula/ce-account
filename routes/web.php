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

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
*/
Route::get('/home', 'HomeController@home')->name('home');

Auth::routes();

Route::post('/user/signin', 'UserController@doLogin')->name('login.do');

Route::get('/', 'UserController@index')->name('user.login');
Route::get('/user/doLogout', 'UserController@makelogout')->name('logout.do');

Route::get('/admin', 'UserController@dashboard')->name('admin');

Route::get('/workers', 'WorkerController@index')->name('workerHome');
Route::get('/workers/create', 'WorkerController@create')->name('new.worker');
Route::post('/worker/add', 'WorkerController@store')->name('add.worker');
Route::resource('/worker', 'WorkerController');

Route::post('/country/showprovinces','CountryController@getprovinces');

Route::post('/province/showcities','ProvinceController@getcities');

Route::get('/student', 'StudentController@index')->name('stud');
Route::get('/student/add', 'StudentController@create')->name('stud.new');
Route::post('/student/insert', 'StudentController@store')->name('stud.add');
Route::post('/student/searchBy', 'StudentController@selectBy')->name('stud.search');
Route::put('/students/{id}/update', 'StudentController@update');
Route::post('/student/getStudentByNif', 'StudentController@selectNIF');
Route::resource('/students', 'StudentController');

Route::get('/class', 'ClassController@index')->name('class');
Route::post('/class/showgrades', 'ClassController@getGrades')->name('class');


Route::get('/quota', 'QuotaController@index')->name('quot');
Route::get('/quota/add', 'QuotaController@create')->name('quot.new');
Route::post('/quota/insert', 'QuotaController@store')->name('quot.add');
Route::post('/quota/getHistoric', 'QuotaController@getStudentQuota')->name('quot.extract');
Route::post('/quota/editquota', 'QuotaController@editStudentQuota')->name('quot.edit');
Route::put('/quota/{id}/update', 'QuotaController@update');
Route::post('/quota/updatequota', 'QuotaController@updateStudentQuota')->name('quota.stud.update');



