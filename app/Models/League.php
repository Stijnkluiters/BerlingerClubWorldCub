<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * MatchModel
 * @mixin Builder
 * @property MatchModel[] $matches
 */
class League extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function matches(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'league_id', 'id');
    }
}
