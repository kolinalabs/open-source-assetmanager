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

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::group([
    'prefix' => 'manufacturer',
    'middleware' => ['auth'],
], function() {
    Route::get('/', 'ManufacturerController@index')->name('manufacturer.index');
    Route::get('/create', 'ManufacturerController@create')->name('manufacturer.create');
    Route::post('/', 'ManufacturerController@store')->name('manufacturer.store');
    Route::get('/{manufacturer}', 'ManufacturerController@show')->name('manufacturer.show');
    Route::get('/{manufacturer}/edit', 'ManufacturerController@edit')->name('manufacturer.edit');
    Route::put('/{manufacturer}', 'ManufacturerController@update')->name('manufacturer.update');
    Route::delete('/{manufacturer}', 'ManufacturerController@destroy')->name('manufacturer.destroy');
});

Route::group([
    'middleware' => ['auth'],
], function() {
    Route::resource('place', 'PlaceController');
    Route::resource('category', 'CategoryController');
    Route::resource('equipment', 'EquipmentController');
});
