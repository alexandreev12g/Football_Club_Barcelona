<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'age',
        'nationality',
        'number_of_goals_this_season',
        'team_id',
        'user_id' 
    ];
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    } 

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
