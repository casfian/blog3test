<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;

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

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/services', [PagesController::class, 'services']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//untuk Posts
//Route::resource('posts', 'PostController');
Route::resource('posts', PostController::class);

Route::get('/download', [PostController::class, 'export']);

//goto Import page with form (a)
Route::get('/posts/importexcel', function () {
    return view('posts.importexcel');
});

//this is route use in action in form (a)
Route::post('/posts/import', [PostController::class, 'import'])->name('posts.import');


