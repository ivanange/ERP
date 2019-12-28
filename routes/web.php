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

/*

Route::get('/json', function () {
    return response()->json([
        'name' => 'Abigail',
        'state' => 'CA'
    ]);
});

*/

Route::resources([
    'flows' => 'FlowController',
    'categories' => 'CategoryController',
    'departments' => 'DepartmentController',
    'flowcategories' => 'FlowcategoryController',
    'posts' => 'PostController',
    'products' => 'ProductController',
    'commands' => 'CommandController',
    'workers' => 'WorkerController'
]);
