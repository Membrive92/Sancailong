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
Route::get('/set_language/{lang}', 'Controller@setLanguage')->name('set_language');
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');



Route::get('/','HomeController@index', function () {
    return view('home', compact('courses'));
});
Route::get('/password/email','PasswordController@getEmail')->name('password.email');
Route::post('/password/reset/','PasswordController@postEmail')->name('password.reset');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'courses'], function () {
    Route::group(['middleware' => ['auth']], function () {


        Route::get('/subscribed', 'CourseController@subscribed')
            ->name('courses.subscribed');
        Route::get('/{course}/inscribe', 'CourseController@inscribe')
            ->name('courses.inscribe');


        Route::post('/add_review', 'CourseController@addReview')
            ->name('courses.add_review');

        Route::group(['middleware' => [sprintf("role:%s", \App\Role::TEACHER)]], function () {

            Route::get('/create', 'CourseController@create')
                ->name('courses.create');

            Route::post('/store', 'CourseController@store')
                ->name('courses.store');


            Route::put('/{course}/update', 'CourseController@update')
                ->name('courses.update');

            Route::get('/{slug}/edit', 'CourseController@edit')
                ->name('courses.edit');

            Route::put('/{course}/update', 'CourseController@update')
                ->name('courses.update');

            Route::delete('/{course}/destroy', 'CourseController@destroy')
                ->name('courses.destroy');


        });


    });
    Route::get('/{course}', 'CourseController@show')->name('courses.detail');
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
    Route::group(['prefix' => "invoices"], function () {
        Route::get('/manage', 'InvoiceController@manage')->name('invoices.manage');
        Route::get('/{invoice}/download', 'InvoiceController@download')->name('invoices.download');
    });
});



Route::group(['prefix' => "solicitude"], function () {
    Route::post('/teacher', 'SolicitudeController@teacher')->name('solicitude.teacher');
});
Route::group(["prefix" => "profile", "middleware" => ["auth"]], function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::put('/', 'ProfileController@update')->name('profile.update');
});


Route::group(['prefix' => "teacher", "middleware" => ["auth"]], function () {
    Route::get('/courses', 'TeacherController@courses')->name('teacher.courses');
    Route::get('/students', 'TeacherController@students')->name('teacher.students');
    Route::post('/send_message_to_student', 'TeacherController@sendMessageToStudent')->name('teacher.send_message_to_student');
});

Route::group(['prefix' => "admin", "middleware" => ['auth', sprintf("role:%s", \App\Role::ADMIN)]], function() {
    Route::get('/courses', 'AdminController@courses')->name('admin.courses');
    Route::get('/courses_json', 'AdminController@coursesJson')->name('admin.courses_json');
    Route::post('/courses/updateStatus', 'AdminController@updateCourseStatus');

});


Route::group(['prefix' => "teacher", "middleware" => ['auth', sprintf("role:%s", \App\Role::TEACHER)]], function() {
       Route::get('/schedule','ScheduleController@edit')->name('teacher.schedule');
    Route::post('/schedule','ScheduleController@store');

});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/appointments/create', 'AppointmentController@create')->name('appointment.create');
    Route::post('/appointments', 'AppointmentController@store');
    Route::get('/courses/{course}/teacher', 'AppointmentController@teachers');
});

Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    // comprobamos con laravel que un archivo existe
    if (File::exists($file)) {
        return Image::make($file)->response();
    }


});
