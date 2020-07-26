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

Route::get('/home', 'Web\HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::group([
    'prefix' => 'manufacturer',
    'middleware' => ['auth'],
], function() {
    Route::get('/', 'Web\ManufacturerController@index')->name('manufacturer.index');
    Route::get('/create', 'Web\ManufacturerController@create')->name('manufacturer.create');
    Route::post('/', 'Web\ManufacturerController@store')->name('manufacturer.store');
    Route::get('/{manufacturer}', 'Web\ManufacturerController@show')->name('manufacturer.show');
    Route::get('/{manufacturer}/edit', 'Web\ManufacturerController@edit')->name('manufacturer.edit');
    Route::put('/{manufacturer}', 'Web\ManufacturerController@update')->name('manufacturer.update');
    Route::delete('/{manufacturer}', 'Web\ManufacturerController@destroy')->name('manufacturer.destroy');
});

Route::group([
    'middleware' => ['auth'],
], function() {
    Route::resource('place', 'Web\PlaceController');
    Route::resource('category', 'Web\CategoryController');
    Route::resource('equipment', 'Web\EquipmentController');
    Route::get('occurrence/{equipment}/list', 'Web\OccurrenceController@list')->name('occurrence.list');
    Route::resource('occurrence', 'Web\OccurrenceController');
});
