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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get("/products/update", function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('welcome');
    });
    Route::get('/stock/stats', function () {
        return view('welcome');
    });

    Route::get('/stock', function () {
        return view('welcome');
    });

    Route::prefix('stock')->group(function () {
        Route::apiResources([
            'categories' => 'CategoryController',
            'products' => 'ProductController',
            'commands' => 'CommandController',
        ]);
    });

    Route::prefix('payroll')->group(function () {
        Route::apiResources([
            'post' => 'PostController',
            'departments' => 'DepartmentController',
            'workers' => 'WorkerController',
        ]);
    });

    Route::get('/payroll','PayController@affiche');
    Route::get('/payroll/posts','PostController@index'); // on doit etre renvoyé sur le dashboard
    Route::post('/payroll/posts','PostController@store'); // enregistrer un poste
    Route::get('/payroll/departments','DepartmentController@index');
    Route::post('/payroll/departments','DepartmentController@store');
    Route::get('/payroll/workers','WorkerController@index');
    Route::post('/payroll/workers','WorkerController@store');
    Route::get('/payroll/paie','BulltinController@index');
    Route::get('/payroll/paie/{Worker}/bulletin','EditController@affiche');
    Route::post('/payroll/paie/{Worker}/bulletin','WorkerController@update');

    Route::prefix('accounting')->group(function () {
        Route::apiResources([
            'flows' => 'FlowController',
            'flowcategories' => 'FlowcategoryController',
        ]);
    });
});
