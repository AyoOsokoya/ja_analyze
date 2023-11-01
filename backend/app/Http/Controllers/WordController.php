<?php

namespace App\Http\Controllers;

use App\Domains\Word\Actions\MakeWordDtoAction;
use App\Domains\Word\Actions\SaveWordDtoAction;
use App\Domains\Word\Models\Reading;
use App\Domains\Word\Models\Sense;
use App\Domains\Word\Models\Word;
use App\Http\Enums\EnumHttpResponseStatusCode;
use App\Http\Responses\StandardApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WordController extends Controller
{
    function AllWords(): JsonResponse
    {
        $response = new StandardApiResponse(
            EnumHttpResponseStatusCode::OK,
            true,
            Word::all(),
            []
        );

        return $response->jsonResponse();
    }

    function AddWord(Request $request): JsonResponse
    {
        $word = Word::first($request->get('word_id'));
        if ($word) {
            $response = new StandardApiResponse(
                EnumHttpResponseStatusCode::OK,
                true,
                [],
                ['Word already exists']
            );

            return $response->jsonResponse();
        }

        $WordDTO = MakeWordDtoAction::make($request->get('word_data'))->execute();
        SaveWordDtoAction::make($WordDTO)->execute();

        $response = new StandardApiResponse(
            EnumHttpResponseStatusCode::OK,
            true,
            [],
            []
        );

        return $response->jsonResponse();
    }

    // Use implicit binding
    function DeleteWord(Request $request): JsonResponse
    {
        $word_id = $request->get("word_id");

        // TODO could be moved to action
        Word::destroy($word_id);
        Sense::destroy(['word_id', $word_id]);
        Reading::destroy(['word_id', $word_id]);

        $response = new StandardApiResponse(
            EnumHttpResponseStatusCode::OK,
            true,
            [],
            []
        );

        return $response->jsonResponse();
    }

    function RandomWordMcq(Request $request): JsonResponse
    {
        // TODO: Needs some work
        if (Word::count() >= config('word.mcq.minimum_word_count')) {
            $random_question_words = Word::inRandomOrder()
                ->limit(config('word.mcq.minimum_word_count'))
                ->with('sense', 'reading')
                ->get();

            return response()->json(json_encode([
                'status' => 'success',
                'data' => $random_question_words,
                'error' => [],
            ]));
        }

        $response = new StandardApiResponse(
            EnumHttpResponseStatusCode::OK,
            true,
            [],
            ['Not enough words to create a quiz. Please add more words.']
        );

        return $response->jsonResponse();
    }

    function CheckRandomWordMcqAnswer(Request $request): JsonResponse
    {
        $success = $request->get('answer') === $request->get('correct_answer');

        $response = new StandardApiResponse(
            EnumHttpResponseStatusCode::OK,
            $success,
            ['correct' => false],
            []
        );

        return $response->jsonResponse();
    }
}
