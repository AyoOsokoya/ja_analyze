<?php
declare(strict_types=1);

namespace App\Domains\Word\Actions;
use App\Domains\Word\Classes\WordDto;

class SaveWordDtoAction
{
    private WordDto $word_dto;
    private function __construct(WordDto $word_dto)
    {
        $this->word_dto = $word_dto;
    }

    public static function make(WordDto $word_dto): SaveWordDtoAction
    {
        return new SaveWordDtoAction($word_dto);
    }

    public function execute(): void
    {
        $this->word_dto->word->save();
        $this->word_dto->senses->each(fn ($sense) => $sense->save());
        $this->word_dto->readings->each(fn ($reading) => ($reading->save()));
    }
}
