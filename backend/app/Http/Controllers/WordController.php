<?php

namespace App\Http\Controllers;

use App\Domains\Word\Actions\MakeWordAction;
use App\Domains\Word\Actions\SaveWordAction;
use App\Domains\Word\Models\Reading;
use App\Domains\Word\Models\Sense;
use App\Domains\Word\Models\Word;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WordController extends Controller
{
    function AllWords(): JsonResponse
    {
        return response()->json([""]);
    }

    function AddWord(Request $request): JsonResponse
    {
        if (Word::find($$request->word_id)) {
            return response()->json([""]);
        }

        $WordDTO = MakeWordAction::make($request->word_data)->execute();
        SaveWordAction::make($WordDTO)->execute();
        return response()->json([""]);
    }

    // Use implicit binding
    function DeleteWord(Request $request): JsonResponse
    {
        $word_id = $request->get("word_id");
        Word::destroy($word_id);
        Sense::destroy(['word_id', $word_id]);
        Reading::destroy(['word_id', $word_id]);

        return response()->json(['delete_word' => $word_id]);
    }

    function RandomWordMcq(Request $request): JsonResponse
    {
        if (Word::count() >= 4) {
            $random_question_words = Word::inRandomOrder()->limit(5)->with('sense', 'reading')->get();

            return response()->json(json_encode([
                'status' => 'success',
                'data' => $random_question_words,
                'error' => [],
            ]));
        }

        return response()->json(json_encode([
            'status' => 'error',
            'data' => [],
            'error' => ['Not enough words to create a quiz. Please add more words.']
        ]));
    }

    function CheckRandomWordMcqAnswer(Request $request): JsonResponse
    {
        if ($request->get('answer') === $request->get('correct_answer')) {
            return response()->json(json_encode([
                'status' => 'success',
                'data' => ['correct' => true],
                'error' => [],
            ]));
        }

        if ($request->get('answer') === $request->get('correct_answer')) {
            return response()->json(json_encode([
                'status' => 'success',
                'data' => ['correct' => false],
                'error' => [],
            ]));
        }
    }
}
