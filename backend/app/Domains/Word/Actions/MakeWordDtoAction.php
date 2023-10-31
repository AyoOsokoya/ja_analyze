<?php
declare(strict_types=1);

namespace App\Domains\Word\Actions;
use App\Domains\Word\Classes\WordDto;
use App\Domains\Word\Models\Reading;
use App\Domains\Word\Models\Sense;
use App\Domains\Word\Models\Word;

class MakeWordDtoAction
{
    private int $token_word_id;
    private array $word_data;
    private function __construct(array $word_data)
    {
        $this->token_word_id = $word_data['token']['word_id'];
        $this->word_data = $word_data;
    }

    public static function make(array $word_data): MakeWordDtoAction
    {
        return new MakeWordDtoAction($word_data);
    }

    public function execute(): WordDto
    {
        return $this->makeWord();
    }

    private function makeWord(): WordDto
    {
        $word_model = new Word([
                'id' => $this->token_word_id,
                'slug' => $this->word_data['slug'],
                'surface_form' => $this->word_data['token']['surface_form'],
        ]);

        $readings = collect();
        foreach($this->word_data['japanese'] as $reading_data) {
            $readings->push($this->makeReading($reading_data));
        }

        $senses = collect();
        foreach($this->word_data['senses'] as $sense_data) {
            $senses->push($this->makeSense($sense_data));
        }

        $token = collect($this->word_data['token']);

        return new WordDto (
           $word_model,
           $senses,
           $readings,
           $token
        );
    }
    private function makeReading(array $reading_data): Reading
    {
        $reading = [
            'word_id' => $this->token_word_id,
            'kanji' => $reading_data['word'] ?? null,
            'reading' => $reading_data['reading'],
        ];

        return new Reading($reading);
    }
    private function makeSense(array $sense_data): Sense
    {

        $sense = [
            'word_id' => $this->token_word_id,
             ...$sense_data,
        ];

        return new Sense($sense);
    }
}
