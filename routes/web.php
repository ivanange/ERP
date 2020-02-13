<?php

use App\Command;


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




Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::resources([
    'categories' => 'CategoryController',
    'products' => 'ProductController',
    'commands' => 'CommandController',
]);

/*
 Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('welcome');
    });

    Route::resources([
        'categories' => 'CategoryController',
        'products' => 'ProductController',
        'commands' => 'CommandController',
    ]);
});
 */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
