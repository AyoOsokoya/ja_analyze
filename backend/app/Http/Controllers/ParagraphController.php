<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParagraphController extends Controller
{
    function paragraphToWords(Request $request)
    {
        $paragraph = $request->post("paragraph");
        // Tokenize Kuromoji
        // Dictionary Jisho

        return $paragraph;
    }
}
