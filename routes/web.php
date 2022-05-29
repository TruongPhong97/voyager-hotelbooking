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

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {

    // Voyager core route
    Voyager::routes();

    // Admin Module Routes
    Route::post('pagebuilder/upload', 'Admin\PagebuilderController@upload')->name('pagebuilder.upload');
    Route::post('pagebuilder/remove', 'Admin\PagebuilderController@remove')->name('pagebuilder.remove');
    Route::post('pagebuilder/save', 'Admin\PagebuilderController@save')->name('pagebuilder.save');

    Route::get('pagebuilder', 'Admin\PagebuilderController@index')->name('pagebuilder');

    Route::get('homepage.content', 'Admin\HomepageContentController@content')->name('homepage.content');
    Route::put('homepage.content/update', 'Admin\HomepageContentController@update')->name('homepage.content.update');

});

/*
|--------------------------------------------------------------------------
| Function routes
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::post('fileUpload', 'FileController@upload')->name('uploadFile');

/*
|--------------------------------------------------------------------------
| Frontend routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'CustomHomeController@index')->name('home');
Route::get('/room', 'Frontend\RoomController@index')->name('room');
Route::get('/room/{slug}', 'Frontend\RoomController@details')->name('room.details');
Route::get('/available-room', 'Frontend\RoomController@available')->name('room.available');
Route::post('/room.details.check', 'Frontend\RoomController@checkSingleRoom')->name('checkSingleRoom');

Route::get('/home', function(){
    return view('home');
});

Route::group(
    [
        'prefix' => '{locale}',
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'setlocale',
        'as' => 'lang.',
    ],
    function(){
        Route::get('/', 'CustomHomeController@index')->name('home');
        Route::get('/room', 'Frontend\RoomController@index')->name('room');
        Route::get('/room/{slug}', 'Frontend\RoomController@details')->name('room.details');
        Route::get('/available-room', 'Frontend\RoomController@available')->name('room.available');
        Route::get('/{slug}', 'Frontend\PageController@dynamicpage')->name('dynamicpage');
    }
);

Route::get('/{slug}', 'Frontend\PageController@dynamicpage')->name('dynamicpage');
