<?php
declare(strict_types = 1);

namespace App\Domains\Paragraph\Actions;

use Illuminate\Support\Facades\Http;

class TokenizeParagraphApiCall
{
    private string $paragraph;
    private function __construct($paragraph)
    {
        $this->paragraph = $paragraph;
    }

    public static function make(string $paragraph): TokenizeParagraphApiCall
    {
        return new TokenizeParagraphApiCall($paragraph);
    }

    public function execute(): array
    {
        $response = Http::retry(3)
            // ->timeout(3)
            ->post(config('api.kuruomji.url'), [
                'paragraph' => $this->paragraph
            ]);

        // Todo: Check that the response is valid
        return json_decode($response->body(), true);
    }
}
