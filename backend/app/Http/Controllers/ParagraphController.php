<?php declare(strict_types=1);

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

        $response = Http::retry(3)
            // ->timeout(3)
            // ->throw()
            ->post(config('api.kuromoji.url'), [
                'paragraph' => $paragraph
            ]);

        $tokenized_words = json_decode($response->body(), true);
        $word_responses = [];

        foreach ($tokenized_words as $index => $token) {
            $word_response = Http::retry(3)
                // ->timeout(3)
                // ->throw()
                ->get(config('api.jisho.url'), [
                    'keyword' => $token['surface_form']
                ]);
            $word_response = json_decode($word_response->body(), true);
            $word_response['data'][$index]['kuruomji'] = $token;
            $word_responses[] = $word_response;
        }
        return Response::json($word_responses);
    }
}
