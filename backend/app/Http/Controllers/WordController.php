<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordController extends Controller
{
    function AllWords()
    {
        // Call API action
        return ["word1", "word2", "word3"];
    }

    function AddWord(Request $request)
    {
        $word = $request->input("word");
        return $word;
    }

    function DeleteWord(Request $request)
    {
        $word = $request->input("word");
        return $word;
    }
}
