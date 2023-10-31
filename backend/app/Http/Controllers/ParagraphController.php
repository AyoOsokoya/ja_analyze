<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Domains\Paragraph\Actions\TokenizeParagraphApiCall;
use App\Domains\Word\Actions\MakeWordDtoAction;
use App\Domains\Word\Actions\TokenToWordFromDictionaryApiCall;
use App\Http\Enums\EnumHttpResponseStatusCode;
use App\Http\Responses\StandardApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParagraphController extends Controller
{
    function paragraphToWords(Request $request): JsonResponse
    {
        // TODO Validate the request
        $paragraph = $request->post("paragraph");
        $tokens = TokenizeParagraphApiCall::make($paragraph)->execute();

        $word_dtos = [];
        foreach ($tokens as $token) {
            // TODO Check that the api call returns a valid response
            $word_response = TokenToWordFromDictionaryApiCall::make($token)->execute();

            // The first word matches the token most accurately
            $first_word_from_response = $word_response['data'][0];
            $first_word_from_response['token'] = $token;
            $word_dtos[] = MakeWordDtoAction::make($first_word_from_response)->execute();
        }

        $api_response = new StandardApiResponse(
            EnumHttpResponseStatusCode::OK,
            true,
            $word_dtos,
            []
        );

        return $api_response->jsonResponse();
    }
}
