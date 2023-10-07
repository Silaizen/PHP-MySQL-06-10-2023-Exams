<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',     
    ];

    public function isExpired()
    {
        $now = Carbon::now();

        return $now->gt($this->end_time);
    }

    public function candidates()
{
    return $this->hasMany(Candidate::class);
}
}