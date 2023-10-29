<?php
declare(strict_types = 1);

namespace App\Domains\Word\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Domains\Word\Models
 *
 * @property integer $id
 * @property string $slug
 * @property string $surface_form
 * @mixin Model
 */
class Word extends Model
{
    // use HasFactory, SoftDeletes;

    protected $table = 'words';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'slug',
        'surface_form',
    ];

    public function readings(): HasMany
    {
        return $this->hasMany(Reading::class);
    }

    public function senses(): HasMany
    {
        return $this->hasMany(Sense::class);
    }
}
