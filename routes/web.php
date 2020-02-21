<?php

use App\Command;
use App\Worker;


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

    Route::get('/home', function () {
        return view('welcome');
    });


    Route::prefix('stock')->group(function () {
        Route::get('', function () {
            return view('welcome');
        });

        Route::get("/products/update", function () {
            return view('welcome');
        });

        Route::get('/stats', function () {
            return view('welcome');
        });

        Route::resources([
            'categories' => 'CategoryController',
            'products' => 'ProductController',
            'commands' => 'CommandController',
        ]);
    });

    Route::prefix('payroll')->group(function () {
        /*
        Route::resources([
            'post' => 'PostController',
            'departments' => 'DepartmentController',
            'workers' => 'WorkerController',
        ]);
*/
        Route::get('', 'PayController@affiche');
        Route::get('/posts', 'PostController@index'); // on doit etre renvoyé sur le dashboard
        Route::post('/posts', 'PostController@store'); // enregistrer un poste
        Route::get('/departments', 'DepartmentController@index');
        Route::post('/departments', 'DepartmentController@store');
        Route::get('/workers', 'WorkerController@index');
        Route::post('/workers', 'WorkerController@store');
        Route::get('/paie', 'BulltinController@index');
        Route::get('/paie/{Worker}/bulletin', 'EditController@affiche');
        Route::post('/paie/{Worker}/bulletin', 'WorkerController@update');
        Route::post('/paie/{worker}/pay', 'WorkerController@pay');
    });


    Route::prefix('accounting')->group(function () {
        Route::get('', function () {
            return view('welcome');
        });
        Route::get('/stats', function () {
            return view('welcome');
        });
        Route::resources([
            'flows' => 'FlowController',
            'flowcategories' => 'FlowcategoryController',
        ]);
    });
});
