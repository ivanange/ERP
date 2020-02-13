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
    Auth::routes();
});


Route::get("/names", function () {
    return App\User::all()->pluck("name")->toJson();
});

Route::apiResources([
    'categories' => 'CategoryController',
    'products' => 'ProductController',
    'commands' => 'CommandController',
], ['middleware' => ["json", 'auth:web']]);

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
