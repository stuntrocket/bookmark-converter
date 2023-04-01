<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmark extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'url',
        'description',
        'status',
        'image',
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
