<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class)->name('home');



Route::get('/register', [RegisterController::class, 'index'])->name('register'); //Esto lo que hace es asignarle un nombre, esto es una ventaja porque va a escanear las peticios con el nombre dado, a las nuevas peticiones 
//Cuando son rutas diferentes se tienen que ponerle nombre diferentes, pero si se llaman igual unicamente se le puede dejar un nombre y la ruta sique siendo la misma, solo el tipo de request cambia
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class,'store'])->name('logout');

// Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');

Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');

Route::post('/posts',[PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post}',[ComentarioController::class, 'store'])->name('comentarios.store');


//Ruta para comunicarnos con el cotrolador de la imagen
Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

//Like a las fotos
Route::post('/posts/{post}/likes}',[LikeController::class, 'store'])->name('posts.likes.store');

Route::delete('/posts/{post}/likes}',[LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Poner dentro de las llaves un modelo, se le reconoce como route model binding
Route::get('/{user:username}',[PostController::class, 'index'])->name('posts.index');

// Siguendo usuarios
Route::post('/{user:username}/follow',[FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class, 'destroy'])->name('users.unfollow');









