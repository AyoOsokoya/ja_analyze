<?php
declare(strict_types=1);

return [
    'kuruomji' => [
        'url' => env('KURUOMJI_API_URL', 'http://localhost:3000'),
    ],
    'jisho' => [
        'url' => env('JISHO_API_URL', 'https://jisho.org/api/v1/search/words?keyword='),
    ],
];
