<?php
declare(strict_types = 1);

namespace App\Domains\Word\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Domains\Word\Models
 *
 * @property integer $id
 * @property integer $word_id
 * @property string $kanji
 * @property string $reading
 * @mixin Model
 */
class Reading extends Model
{
    // use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'readings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'word_id',
        'kanji',
        'reading',
    ];

    public function word(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
