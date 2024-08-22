<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\todolist\TodolistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class,'index']);


Route::get('/todolist', [TodolistController::class,'index'])-> name('todolist');
Route::post('/todolist', [TodolistController::class,'store'])-> name('todolist.post');
Route::put('/todolist/{id}', [TodolistController::class,'update'])->name('todolist.update');
Route::delete('/todolist/{id}', [TodolistController::class,'destroy'])->name('todolist.delete');




