<?php
declare(strict_types=1);

return [
    'mcq' => [
        'minimum_word_count' => env('MCQ_MINIMUM_WORD_COUNT', '4'),
        'maximum_meaning_options' => env('MCQ_MAXIMUM_MEANING_OPTIONS', '4'),
    ],
];
