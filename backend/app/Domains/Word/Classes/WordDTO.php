<?php
declare(strict_types=1);

namespace App\Domains\Word\Classes;

use App\Domains\Word\Models\Word;
use Illuminate\Support\Collection;


class WordDTO
{
    public Word $word;
    public Collection $senses;
    public Collection $readings;

    public function __construct(Word $word, Collection $senses, Collection $readings)
    {
        $this->word = $word;
        $this->senses = $senses;
        $this->readings = $readings;
    }
}
