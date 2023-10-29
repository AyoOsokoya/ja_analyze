<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WordController extends Controller
{
    function AllWords(): JsonResponse
    {
        // Call API action
        return response()->json([""]);
    }

    function AddWord(Request $request): JsonResponse
    {
        // save the word if it does not exist
        return response()->json([""]);
    }

    function DeleteWord(Request $request): JsonResponse
    {
        // Delete word if it does not exist
        return response()->json([""]);
    }

    function RandomWordMcq(Request $request): JsonResponse
    {
        // if more than 4 words create
        // if less than 4 words return error
        return response()->json([""]);
    }

    function CheckRandomWordMcqAnswer(Request $request): JsonResponse
    {
        // Return true or false
        return response()->json([""]);
    }
}
