<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Goal
 * @mixin Builder
 */
class Goal extends Model
{
    protected $fillable = ['goal_type'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'match_id', 'id');
    }
}
