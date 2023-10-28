<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class ParagraphController extends Controller
{
    function paragraphToWords(Request $request): JsonResponse
    {
        $paragraph = $request->post("paragraph");

        $response = Http::retry(3, 100)
            ->timeout(3)
            // ->throw()
            ->post(config('api.kuromoji.url'), [
                'paragraph' => $paragraph
            ]);

        $tokenized_words = json_decode($response->body(), true);
        $word_responses = [];

        foreach ($tokenized_words as $token) {
            $word_responses[] = Http::retry(3, 100)
                ->timeout(3)
                // ->throw()
                ->get(config('api.jisho.url'), [
                    'keyword' => $token['surface_form']
                ]);
        }

        $words_return = collect($word_responses)->map(function ($word) {
            return json_decode($word->body(), true);
        });

        return Response::json($words_return);
    }
}
