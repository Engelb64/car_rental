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


Route::get('', 'CarController@CarsAvailable')->name('index');

Route::get('details/{id}', 'CarController@CarDetails')->name('details')->middleware('auth');
Route::post('details/{id}', 'CarController@RentCar')->middleware('auth');
Route::view('RentaExitosa', 'landing.succesfull');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('Admin Dashboard')->middleware('auth');

// Car API
Route::prefix('Car')
    ->middleware('auth')
    ->group(function () {
        Route::get('/search', 'CarController@search');
        Route::get('/Models', 'CarController@Models');
        Route::get('/reports', 'CarController@Reports')->name('Reports');

        // CRUD
        Route::get('', 'CarController@all')->name('car.list');
        Route::post('', 'CarController@create');
        Route::get('{id}', 'CarController@read');
        Route::put('{id}', 'CarController@update');
        Route::delete('{id}', 'CarController@delete');
    });

Route::prefix('Brand')
    ->middleware('auth')
    ->group(function () {

        // CRUD
        Route::get('', 'BrandController@all')->name('brand.list');
        Route::post('', 'BrandController@create');
        Route::delete('{id}', 'BrandController@delete');
    });

Route::prefix('Model')
    ->middleware('auth')
    ->group(function () {

        // CRUD
        Route::get('', 'ModelController@all')->name('model.list');
        Route::post('', 'ModelController@create');
        Route::delete('{id}', 'ModelController@delete');
    });

Route::prefix('RentalDate')->group(function () {
    // CRUD
    Route::get('', 'RentalDateController@all')->name('car.calendar');
});

Auth::routes();
