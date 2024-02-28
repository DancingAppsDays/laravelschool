<?php

use Illuminate\Support\Facades\Route;

use App\Mail\MailPreregistro;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PreregistroController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send', '\App\Http\Controllers\PreregistroController@send')->name('home.send');

Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
     // \Mail::to('ba55yunky@gmail.com')->send(new \App\Mail\NotMail($details));
   
    dd("Email is Sent.");
});


Route::get('/testroute', function() {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('ba55yunky@gmail.com')->send(new MailPreregistro($name));
});

Route::get('/tes', [PreregistroController::class, 'sendWelcomeEmail']);