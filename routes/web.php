<?php

use App\Http\Controllers\ClacController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// lien vers l'accueil
Route::get('/', function () {
    return view('welcome');
});

// lien vers la page d'ajout de job
Route::get('/job/create', function () {
    return view('addjob');
});

// lien vers la page de connexion
Route::get('/login', function () {
    return view('login');
});

// lien vers la sauvegarde de nouvel utilisateur

Route::post('/createUser', [UserController::class, 'store']);

Route::get('/signup', function(){
    return view('signup');
});

// lien vers la connexion
Route::post('/handlelogin', [UserController::class, 'handlelogin']);

// lien vers la deconnexion
Route::post('/logout', [UserController::class, 'logout']);


// lien vers la liste des jobs avec route nommee
Route::get('/alljobs', [ClacController::class, 'alljobs'])->name('kibabu');

// lien vers la liste des jobs avec route nommee
Route::get('/myjobs', [UserController::class, 'jobsPerUSer']);

Route::post('/job/add', [ClacController::class, 'addJob']);






