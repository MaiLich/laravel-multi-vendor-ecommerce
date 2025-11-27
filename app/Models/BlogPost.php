<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Admin;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = ['author_id','title','slug','thumbnail','content','status','published_at'];


    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Quan hệ
    public function author(){
        return $this->belongsTo(Admin::class, 'author_id');
    }
    public function comments(){ return $this->hasMany(BlogComment::class, 'post_id'); }

    // Helpers
    protected static function booted() {
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . Str::random(6);
            }
            if ($post->status === 'published' && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . Str::random(6);
            }
        });
    }

    // Scopes
    public function scopePublished($q){
        return $q->where('status','published')->whereNotNull('published_at');
    }
}
