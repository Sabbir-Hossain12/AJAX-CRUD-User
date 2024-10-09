<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.pages.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Eloquent Relationships
//Blog + Like + Comment +share +Tags 


//1. One to One and Inverse
//
//2. One to Many or Inverse

//3. Many to Many


//Has Relationships

//Blog----------------------->Comment
//Parent---------------------->Child
//
////Belongs Relationships
//
//Child--------------------------->Parent
//Comment--------------------------->Blog



Route::resource('/posts', PostController::class)->names('post');

//Route::resource('/comments', CommentController::class)->names('comment');


Route::get('/comment/{id}', [CommentController::class, 'index'])->name('comment.index');




//04/10/2024
Route::resource('/users', UserController::class)->names('user');
Route::get('/user/get-data', [UserController::class, 'getUserData'])->name('user.getdata');


//Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
//GET            users .................................................................................................... user.index › UserController@index
//POST            users .................................................................................................... user.store › UserController@store  
//  GET|HEAD        users/create ........................................................................................... user.create › UserController@create  
//  GET|HEAD        users/{user} ............................................................................................... user.show › UserController@show  
//  PUT|PATCH       users/{user} ........................................................................................... user.update › UserController@update  
//  DELETE          users/{user} ......................................................................................... user.destroy › UserController@destroy  
//  GET|HEAD        users/{user}/edit .......................................................................................... user.edit › UserController@edit  



//
//posts-----------------post_tag-------------------tags
//title,                  post_id,
//                        tag_idsdad
//image


//200-299= all ok
//
//200=ok
// 201=created
//     
//
//300-400 = client error
//
//400-500 = server error
//
//401= Unauthorized,
//403=Forbidden.
//404= not found.
//419= CSRF token expired
//    500=server error


//Client Side: Jquery Datatable.
//Server Side: Yajra box Datatable (JQUERY)
    