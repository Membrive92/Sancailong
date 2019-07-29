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
Route::get('/set_language/{lang}','Controller@setLanguage')->name('set_language');
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'courses'], function (){
    Route::get('/{course}','CourseController@show')->name('courses.detail');
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/plans', 'SubscriptionController@plans')
            ->name('subscription.plans');
        Route::get('/admin', 'SubscriptionController@admin')
            ->name('subscription.admin');
        Route::post('/process_subscription', 'SubscriptionController@processSubscription')
            ->name('subscription.process_subscription');
        Route::post('/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
        Route::post('/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
    });
    Route::group(['prefix' => "invoices"], function() {
        Route::get('/manage', 'InvoiceController@manage')->name('invoices.manage');
        Route::get('/{invoice}/download', 'InvoiceController@download')->name('invoices.download');
    });
});





Route::get('/images/{path}/{attachment}', function($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    // comprobamos con laravel que un archivo existe
    if(File::exists($file)) {
        return Image::make($file)->response();
    }


});