<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\ParagraphController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')
    ->group(function () {
        Route::post('paragraph_to_words', [ParagraphController::class, 'paragraphToWords']);

        Route::prefix('word')->group(function () {
            // Route::post('/', [WordController::class, 'AddWord']);
            // Route::delete('/{word:id}', [WordController::class, 'DeleteWord']);
            // Route::get('/random_mcq', [WordController::class, 'RandomWordMcq']);
            // Route::post('/check_random_word_mcq_answer',
                // [WordController::class, 'CheckRandomWordMcqAnswer']);
        });

        // Route::get('/words/', [WordController::class, 'allWords']);
    });
