<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Team
 *
 * @mixin Builder
 * @property Goal[] $goals
 * @property string $name
 */
class Team extends Model
{
    protected $fillable = ['name'];

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'id', 'goal_id');
    }
}
