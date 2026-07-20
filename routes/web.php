<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [AuthController::class, 'showLogin'] )->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.do');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('register.do');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('product')->group(function(){
Route::get('/list', function(){
    return "<h1>Product List</h1>";
})->name('product.list');

    Route::get('/detail', function(){
        return "<h1>Product Detail</h1>";
    })->name('product.detail');
});

Route::get('/hubungi-kami', function(){
    return "<h1>Contact Us</h1>";
});

Route::redirect('/contact-us', '/hubungi-kami');

// Route::get("/home/{nama}", function($nama){
//     return "<h1>Hello $nama</h1>";
// })->name('home');

Route::middleware('auth')->group(function(){
    Route::get("/home", [HomeController::class, 'showHome'])->name('home');

    Route::prefix('students')->name('students.')->group(function(){
        Route::get('/create', [StudentController::class, 'showCreate'])->name('create');
        Route::post('/create', [StudentController::class, 'insertStudent'])->name('insert');
        Route::get('/edit/{id}', [StudentController::class, 'showEdit'])->name('edit');
        Route::patch('/edit/{id}', [StudentController::class, 'updateStudent'])->name('update');
        Route::delete('/delete/{id}', [StudentController::class, 'deleteStudent'])->name('delete');
        Route::post('/score/create', [StudentController::class, 'insertScore'])->name('score.insert');
        Route::post('/predict/{id}', [StudentController::class, 'predictScore'])->name('predict');
        Route::get('/{id}', [StudentController::class, 'detail'])->name('detail');
        Route::get('/score/{id}/edit', [StudentController::Class, 'edit'])->name('score.edit');
        Route::put('/score/{id}', [StudentController::class, 'editNilai'])->name('score.update');
    });

});

Route::get('/language/{locale}', 
    [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/about', [AboutController::class, 'index'])->name('about.view');