<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\fonctionController;
use App\Http\Controllers\variableController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WidgetController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::get('last4projects', [PassportAuthController::class, 'getLast4Projects']);
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [PassportAuthController::class, 'logout']);
    Route::get('get-user', [UserController::class, 'userInfo']);
    Route::get('UserProjects', [UserController::class, 'getProjects']);
    Route::get('{project}/fonctionsProject', [UserController::class, 'fonctionsByProject']);
    Route::get('{project}/variablesProject', [UserController::class, 'variablesByProject']);
    Route::middleware('is_admin')->group(function () {
        Route::get('AdminUsers', [AdminController::class, 'users']);
        Route::get('AdminUser/{id}', [AdminController::class, 'getUserById']);
        Route::get('AdminProject/{user}/{id}', [AdminController::class, 'getProjectById']);
        Route::get('AdminProjects', [AdminController::class, 'projects']);
        Route::post('AdminAlloy/{project}/{user}', [AdminController::class, 'setDeveloper']);
        Route::get('AdminDevs/{project}', [AdminController::class, 'getDevelopers']);
        Route::delete('AdminRemove/{project}/{user}', [AdminController::class, 'removeDeveloper']);
    });
    Route::resource('{user}/projects', ProjectController::class);
    Route::resource('projects/{project}/pages', pageController::class);
    Route::resource('pages/{page}/fonctions', fonctionController::class);
    Route::resource('pages/{page}/variables', variableController::class);
    Route::resource('pages/{page}/widgets', WidgetController::class);
});

