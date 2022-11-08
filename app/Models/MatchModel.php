<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * MatchModel
 * @mixin Builder
 * @property int $id
 * @property Team $teamA
 * @property Team $teamB
 * @property Team $winningTeam
 * @property Goal[] $goals
 * @property int $highestScore

 */
class MatchModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_a_id',
        'team_b_id',
        'league_id',
        'team_a_score',
        'team_b_score',
        'highest_score',
        'winning_team_id'
    ];

    protected $table = 'matches';

    public function teamA(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_A_id', 'id');
    }

    public function teamB(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_B_id', 'id');
    }

    public function winningTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_B_id', 'id');
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'match_id', 'id');
    }
}
