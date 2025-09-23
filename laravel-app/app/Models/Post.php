<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'text',
        'media_type',
        'media_url',
        'status',
    ];


    protected $casts = [
        'status' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reacts()
    {
        return $this->hasMany(React::class);
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

     public function getReactCountAttribute()
    {
        return $this->reacts()->count();
    }

    public function getIsReactedAttribute()
    {
        return auth()->check() 
            ? $this->reacts()->where('user_id', auth()->id())->exists()
            : false;
    }
}
