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

    Route::prefix('accounting')->group(function () {
        Route::get('', function () {
            return view('welcome');
        });
        Route::get('/stats', function () {
            return view('welcome');
        });
        Route::apiResources([
            'flows' => 'FlowController',
            'flowcategories' => 'FlowcategoryController',
        ]);
    });
});
