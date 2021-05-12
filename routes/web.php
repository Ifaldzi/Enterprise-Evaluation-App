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
Route::get('/', function(){
    return redirect()->route('home');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('home');

    Route::get('/pertanyaan/{tipeEvaluasi}', 'UserPageController@showQuestion')->name('user.pertanyaan');
    Route::post('/pertanyaan/{tipeEvaluasi}/submit', 'UserPageController@submitAnswer')->name('user.submit_answer');
    Route::get('/pertanyaan/{tipeEvaluasi}/hasil', 'UserPageController@showScore')->name('user.hasil');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/admin/dashboard', 'AdminController@showDashboard')->name('admin.dashboard');
        Route::get('/admin/pertanyaan', 'PertanyaanController@index')->name('list_pertanyaan');
        Route::get('/admin/pertanyaan/add', 'AdminController@showQuestionForm')->name('form_pertanyaan');
        Route::get('/admin/pertanyaan/detail/{id}', 'PertanyaanController@detail')->name('detail_pertanyaan');

        Route::post('/admin/pertanyaan/add', 'PertanyaanController@insert')->name('insert_pertanyaan');
        Route::post('/admin/pertanyaan/detail/{id}/update', 'PertanyaanController@update')->name('update_pertanyaan');

        Route::delete('/admin/pertanyaan/{id}', 'PertanyaanController@delete')->name('delete_pertanyaan');

        Route::resource('/admin/struktur', 'StrukturController');
        Route::resource('/admin/user', 'UserController');
    });
});


Route::get('/login', 'UserAuthController@showLoginForm')->name('login');
Route::post('/login', 'UserAuthController@login')->name('login');
Route::get('/register', 'UserAuthController@showRegisterForm')->name('register');
Route::post('/logout', 'UserAuthController@logout')->name('logout');
