<?php

use App\Http\Controllers\TweetsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     $users = User::all();
//     return Inertia::render('UserTweets', [
//             'users' => $users,
//             'tweets' => $users->tweets()->paginate()
//         ]);
// });
    

Route::get('/', [TweetsController::class, 'index']);
Route::get('/{user:username}', [TweetsController::class, 'users']);