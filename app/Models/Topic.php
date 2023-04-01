<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'topic_id',
        'status',
    ];

    public function bookmarks()
    {
        return $this->belongsToMany(Bookmark::class);
    }

    public function parentTopic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function childTopics()
    {
        return $this->hasMany(Topic::class, 'topic_id');
    }
}
