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

Route::post('/refer', 'ReferralController@store')->name('refer');

Auth::routes(['verify' => true]);


Route::prefix('dashboard')->middleware('verified')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/referrals', 'ReferralController@index')->name('referrals_list');
});