<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Tweet;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tweets', function () {
    return Tweet::query()
        ->with('user:id,name,username,avatar,location,link,link_text,profile')
        ->latest()
        ->paginate(10);
});

Route::get('/tweets/{tweet}', function (Tweet $tweet) {
    return $tweet->load('user:id,name,username,avatar,location,link,link_text,profile');
});

Route::get('/users/{user}', function (User $user) {
    return $user;
});

Route::get('/users/{user}/tweets', function (User $user) {
    return $user->tweets()
        ->with('user:id,name,username,avatar,location,link,link_text,profile')
        ->latest()
        ->paginate(10);
});
