<?php

use App\Http\Controllers\alluController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\userController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoController;
use App\Http\Controllers\DetailViewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SavePostController;
use App\Http\Controllers\ShareButtonController;
use App\Http\Controllers\UserController as ControllersUserController;
use App\Http\Controllers\welcome;
use Illuminate\Support\Facades\{Route, Auth};



Auth::routes(['verify' => true]);


Route::controller(welcome::class)->group(function () {
    Route::get('/','index')->name('welcome.index');
    Route::get('/posts/{slug}','show')->name('post.detail');

    Route::post('/', 'StoreComment')->name("comment"); 
    Route::delete('/comments/{id}', 'destroy')->name('comments.destroy'); //hapus comment
    Route::put('/comments/{comment}', 'update')->name('comments.update'); // edit comment

    Route::get('/post/category/{category}','showCategory')->name('post.category'); //menampilkan kategory yang di klik 
    Route::get('/post/tag/{tag}','showTag')->name('post.tag');  //menampilkan tag yang di klik 
});


Route::middleware(['auth', 'active.user'])->group(function () {
    
    // save post
    Route::controller(SavePostController::class)->group(function () {
        Route::get('/post-saves/{post}', 'show')->name('post-saves.show');
        Route::post('/post-saves/{post}', 'store')->name('post-saves.store');
        Route::delete('/post-saves/{post}', 'destroy')->name('post-saves.destroy');
    })->middleware('auth');

    // Likes
    Route::controller(LikeController::class)->group(function () {
        // Route::get('/post-saves/{post}', 'show')->name('likes.show');
        Route::post('/likes/{post}', 'store')->name('likes.store');
        Route::delete('/likes/{post}', 'destroy')->name('likes.destroy');
    })->middleware('auth');
    

    

    
        Route::get('/home', HomeController::class)->name('home');
        
        Route::get('verify/{token}', 'VerificationController@verify')->name('verify')->middleware('verified');

        
        Route::get('/update/users/{id}',[UpdateUserController::class, 'edit'])->name('edit');
        Route::post('/update/users/submit',[UpdateUserController::class, 'update']);




    Route::middleware(['member'])->group(function () {
        // user
        // Route::get('alluser',[alluController::class, 'alluser'])->name('alluser');
        // Route::delete('alluser/{id}',[alluController::class, 'destory'])-> name('alluser.destory');




        Route::prefix('my-profile')->middleware(['auth', 'signed'])->group(function() {
            Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
            Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
        });


        // untuk slas user / halaman daftar user
        Route::prefix('user')->middleware('roleCek')->group(function() {
            Route::controller(UserController::class)->group(function () {
                Route::get('/list',  'list')->name('user.list');
                Route::get('/',  'index')->name('user.index');
                Route::get('/create', 'create')->name('create.user'); //mengarah ke halaman tag create
                Route::put('/', 'store')->name('input.user'); //membuat user

                Route::delete('/delete/{user}', 'destroy')->name('destroy');
                
            });
        });


        // untuk detail user
        Route::get('/show/{id}',[DetailUserController::class, 'show'])->name('show');
        Route::put('/show/{id}',[DetailUserController::class, 'update'])->name('show.update');


        // halaman tag
        Route::prefix('tag')->group(function() {
            Route::controller(TagController::class)->group(function () {
                Route::get('/',  'index')->name('tag.index');
                Route::get('/tag',  'list')->name('tag.list');
                Route::get('/create', 'create')->name('tag.create'); //mengarah ke halaman tag create
                Route::put('/', 'store')->name('tag.input'); //input tag
                Route::get('/{tag}', 'edit')->name('tag.edit'); 
                Route::put('/{tag}', 'update')->name('user.update');
                Route::delete('/{tag}', 'destroy')->name('tag.destroy');
            });
        });


        // halaman category
        Route::prefix('category')->group(function() {
            Route::controller(CategoController::class)->group(function () {
                Route::get('/',  'index')->name('catego.index');
                Route::get('/catego',  'list')->name('catego.list');
                Route::get('/create', 'create')->name('catego.create'); //mengarah ke halaman tag create
                Route::put('/', 'store')->name('catego.input'); //input tag
                Route::get('/{category}', 'edit')->name('catego.edit'); 
                Route::put('/{category}', 'update')->name('catego.update');
                Route::delete('/{category}', 'destroy')->name('catego.destroy');
            });
        });


        // halaman post
        Route::prefix('post')->group(function() {
            Route::controller(PostController::class)->group(function () {
                Route::get('/',  'index')->name('post.index');
                Route::get('/post',  'list')->name('post.list');
                Route::get('/create', 'create')->name('post.create'); 
                Route::put('/', 'store')->name('post.input'); 
                Route::get('/{post}', 'edit')->name('post.edit'); 
                Route::put('/{post}', 'update')->name('post.update');
                Route::delete('/{post}', 'destroy')->name('post.destroy');
            });
        });


        // like
        Route::post('/like', [LikeController::class, 'like'])->name('like');
        Route::delete('/unlike', [LikeController::class, 'unlike'])->name('unlike');
        

    });


});