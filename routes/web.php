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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Backend\PostController;

//Ruta para crear el link simbolico de storage
Route::get('storage-link', function () {
    Artisan::call('storage:link');
});

//Definimos la ruta para lista de Posts
Route::get('/', [PageController::class,'posts']);

//Ruta para post en particular
Route::get('blog/{post:slug}', [PageController::class, 'post'])->name('post');

//Ruta del tipo recursos (Lado privado del sitio)
Route::resource('/posts', PostController::class)
  ->middleware('auth')
  ->except('show');

Route::put('/{id}/posts/restore', [PostController::class, 'restore'])
  ->name('posts.restore')
  ->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


