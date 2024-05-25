<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'published_at',
    ];

    public function getPublishedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y', $value)->startOfYear() : null;
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? Carbon::createFromFormat('Y', $value)->startOfYear()->year : null;
    }

    protected $fillable = [
        'title',
        'description',
        'image',
        'published_at',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}

