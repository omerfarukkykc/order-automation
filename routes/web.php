<?php

use App\Http\Controllers\DenemeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/deneme', 'DenemeController@index');

Route::get('/', function () {
    return Redirect("/login");
});
Route::get('/orderpreparing/{order_id}','ClientController@orderPreparing' );
Route::post('/checkorder','ClientController@checkOrder' );
require_once __DIR__ . '/jetstream.php';
