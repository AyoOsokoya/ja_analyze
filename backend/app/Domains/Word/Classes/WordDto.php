<?php
declare(strict_types=1);

namespace App\Domains\Word\Classes;

use App\Domains\Word\Models\Word;
use Illuminate\Support\Collection;

class WordDto
{
    public Word $word;
    public Collection $senses;
    public Collection $readings;
    public Collection $token;
    public bool $does_exist;

    public function __construct(
        Word $word,
        Collection $senses,
        Collection $readings,
        Collection $tokens,
        bool $does_exist = false
    ){
        $this->word = $word;
        $this->senses = $senses;
        $this->readings = $readings;
        $this->token = $tokens;
        $this->does_exist = $this->doesExistInVocabulary();
    }
    public function doesExistInVocabulary(): bool
    {
        return Word::where('id', $this->token['word_id'])->exists();
    }
}
