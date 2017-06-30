<?php

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

use \App\Events\MessagePosted;

Route::get('/', function () {
    return view('welcome');
});

Route::get('chat', function() {
    return view('chat');
})->middleware(['auth']);

Route::middleware('auth')->group(function() {
    Route::prefix('/messages')->group(function() {
        Route::get('/', function () {
            return \App\Message::with('user')->get();
        });

        Route::post('/add-message', function(\Illuminate\Http\Request $request) {
            $user = Auth::user();

            $message = $user->messages()->create(
                [
                    'message' => request()->get('message')
                ]
            );

            // Quando um mensagem for postada ele dispara um evento
            broadcast(new MessagePosted($message, $user))->toOthers();

            return response()->json(['ok']);
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
