<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\News\IndexController;
use App\Http\Controllers\News\ShowController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', IndexController::class)->name('new.index');
Route::get('new/{new}', ShowController::class)->name('new.show');

Route::group([
    'prefix' => 'admin/new',
    'namespace' => 'App\Http\Controllers\Admin\News',
    'middleware' => 'auth',
    'as' => 'admin.new.'],
    function (){
        Route::get('create', 'CreateController')->name('create');
        Route::post('store', 'StoreController')->name('store');
        Route::get('{new}/edit', 'EditController')->name('edit');
        Route::patch('{new}', 'UpdateController')->name('update');
        Route::delete('{new}', 'DestroyController')->name('destroy');
    });
Auth::routes();
