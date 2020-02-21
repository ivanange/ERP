<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Json;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('json')->group(function () {
    Auth::routes(['register' => false]);
    Route::post("/products/update", "ProductController@massUpdate");
});


Route::get("/names", "WorkerController@names");


Route::middleware(['json', 'auth:web'])->group(function () {
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

    Route::prefix('accounting')->group(function () {
        Route::get("/dues", "FlowController@dues");
        Route::apiResources([
            'flows' => 'FlowController',
            'flowcategories' => 'FlowcategoryController',
        ]);
    });
});



/*
Route::middleware(['json'])->group(function () {

    Route::apiResources([
        'categories' => 'CategoryController',
        'products' => 'ProductController',
        'commands' => 'CommandController',
    ]);
});

Route::apiResources([
    'categories' => 'CategoryController',
    'products' => 'ProductController',
    'commands' => 'CommandController',
]);
*/
