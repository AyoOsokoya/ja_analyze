<?php
declare(strict_types = 1);

namespace App\Domains\Word\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Domains\Word\Models
 *
 * @property integer $id
 * @property array $word_id
 * @property array $english_definitions
 * @property array $parts_of_speech
 * @property array $links
 * @property array $tags
 * @property array $restrictions
 * @property array $see_also
 * @property array $antonyms
 * @property array $source
 * @property array $info
 * @property array $sentences
 * @mixin Model
 */
class Sense extends Model
{
    // use HasFactory, SoftDeletes;

    protected $table = 'senses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'word_id',
        'english_definitions',
        'parts_of_speech',
        'tags',
        'restrictions',
        'see_also',
        'antonyms',
        'source',
        'info',
        'sentences',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'english_definitions' => 'array',
        'parts_of_speech' => 'array',
        'links' => 'array',
        'tags' => 'array',
        'restrictions' => 'array',
        'see_also' => 'array',
        'antonyms' => 'array',
        'source' => 'array',
        'info' => 'array',
        'sentences' => 'array',
    ];

    function word(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
