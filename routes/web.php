<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/posts',function(){
//     return 'posts list';
// });

// Route::get('/posts/detail',function(){
//     return 'posts detail';
// });

// Route::get('/posts/show',function(){
//     return 'posts show';
// })->name('posts.show');

//dynamic route
// Route::get('/posts/show/{id}',function($id){
//     return "posts detail- $id";
// });

//Route::get('/posts/more',function(){
    //return redirect('posts.show');
//     return redirect()->route('posts.show');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//list all posts
Route::get('/',([PostController::class,'index']))->name('all.posts');
Route::get('/posts',([PostController::class,'index']));

//create post route
Route::get('/posts/create',([PostController::class,'create']))
       ->name('posts.create');
Route::post('/posts/create',([PostController::class,'store']))
       ->name('posts.store');       

//edit post route
Route::get('posts/edit/{id}',([PostController::class,'edit']))
       ->name('posts.edit');
Route::put('posts/edit/{id}',([PostController::class,'update']))
       ->name('posts.update');              
//show post detail
Route::get('/posts/show/{id}',([PostController::class,'show']));

//delete post route
Route::get('/posts/delete/{id}',([PostController::class,'destroy']))
       ->name('posts.delete');

//create post comment route
Route::post('/comments/store',([CommentController::class,'store']))
       ->name('comments.store');

//post commment route delete
Route::get('/comments/{id}/delete',([CommentController::class,'destroy']))
       ->name('comments.destroy');       
