<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParagraphController extends Controller
{
    function paragraphToWords(Request $request)
    {
        $paragraph = $request->post("paragraph");

        $response = Http::get(config('api.kuromoji.url'). '?' . 'paragraph=' . $paragraph);
        $tokenized_paragraph = collect($response);

        $words = [];
        foreach($tokenized_paragraph as $token) {
            $words[] = $token->jisho = Http::get('https://jisho.org/api/v1/search/words?keyword=' . $token->surface_form);
        }

        // Tokenize Kuromoji
        // Dictionary Jisho

        return $paragraph;
    }
}
