<?php
use Illuminate\Support\Facades\Auth;

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

    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/ambassadors', 'DashboardController@ambassadors')->name('ambassadors');
    Route::get('/api/referrals', 'ReferralController@index')->name('referrals_list');
    Route::get('/api/ambassadors', 'AmbassadorController@index')->name('ambassadors_list');
    Route::post('/api/referrals/{referral}', 'ReferralController@update')->name('referrals_update');
    Route::get('/api/delete_referrals/{referral}', 'ReferralController@destroy')->name('referrals_delete');
    Route::get('/api/delete_ambassadors/{ambassador}', 'AmbassadorController@destroy')->name('ambassadors_delete');


    Route::get('mailtest', function () {
        $referral = App\Referral::find(1);
        $ambassador = App\Ambassador::find(1);
        return (new App\Notifications\NewReferral([
            'referral' => $referral,
            'ambassador' => $ambassador,
        ]))->toMail(Auth::user());
    });
});
