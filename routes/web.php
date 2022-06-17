<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::get('login', function () {
        return view('login');
    });

    Route::get('register', function () {
        return view('register');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view("home");
    });

    Route::get('new/email', function () {
        return view("create_email");
    });

    Route::get('emails/favorites', function () {
        return view("emails_favorites");
    })->name("emails_favorites");

    Route::get('emails/sends', function () {
        return view("emails_sends");
    })->name("emails_sends");

    Route::get('emails/archiveds', function () {
        return view("emails_archived");
    })->name("emails_tofiles");

    Route::get('emails/spams', function () {
        return view("emails_spams");
    })->name("emails_spams");

    Route::get('emails/trash', function () {
        return view("emails_trash");
    })->name("emails_trash");

    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect("login");
    });
});
