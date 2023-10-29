<?php
declare(strict_types = 1);

namespace App\Domains\Word\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Domains\Word\Models
 *
 * @property integer $id
 * @property string $slug
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
    ];

    public function readings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reading::class);
    }

    public function senses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Sense::class);
    }
}
