<?php
declare(strict_types = 1);

namespace App\Domains\Word\Actions;

use Illuminate\Support\Facades\Http;

class TokenToWordFromDictionaryApiCall
{
    private array $token;

    private function __construct($token)
    {
        $this->token = $token;

    }

    public static function make($token): TokenToWordFromDictionaryApiCall
    {
        return new TokenToWordFromDictionaryApiCall($token);
    }

    public function execute(): array
    {

        $response = Http::retry(3)
            // ->timeout(3)
            ->get(config('api.jisho.url'), [
                'keyword' => $this->token['surface_form']
            ]);

        return json_decode($response->body(), true);
    }
}
