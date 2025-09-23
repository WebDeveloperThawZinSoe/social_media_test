<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'reaction_type',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'user_id' => 'integer',
        'post_id' => 'integer',
    ];

    /**
     * Get the user that owns this reaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that this reaction belongs to.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Scope to filter by reaction type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('reaction_type', $type);
    }
}
