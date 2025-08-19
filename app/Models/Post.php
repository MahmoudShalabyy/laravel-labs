<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title','description', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}


    //  Accessors

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getShortDescriptionAttribute()
    {
        return substr($this->description, 0, 50) . '...';
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d-M-Y');
    }
}
