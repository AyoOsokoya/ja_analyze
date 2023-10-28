<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class ParagraphController extends Controller
{
    function paragraphToWords(Request $request) : JsonResponse
    {
        $paragraph = $request->post("paragraph");

        $response = Http::retry(3, 100)
            ->timeout(3)
            // ->throw()
            ->post(config('api.kuromoji.url'), [
            'paragraph' => $paragraph
        ]);

        return Response::json($response->json());
        // return $tokenized_paragraph;

        // $words = [];
        // foreach ($tokenized_paragraph as $token) {
        //     $words[] = $token->jisho = Http::get('https://jisho.org/api/v1/search/words?keyword=' . $token['surface_form']);
        // }

        // Return error

        // return $paragraph;
    }
}
