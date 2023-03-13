<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;


    protected $guarded = ['id'];

    protected $attributes =['created_by' => '', 'postImages' => '',];

    protected $hidden = ['created_at', 'updated_at'];

    protected $with =['category', 'tag'];



    public function scopeFilter($query, array $filters)
    {
        // Category //
        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('name', $category);
            });
        });
        // Tag //
        $query->when(isset($filters['tag']), function ($query) use ($filters) { 
            $query->whereHas('tag', function ($query) use ($filters) { 
                $query->where('name', $filters['tag']); 
            }); 
        });
        // User //
        $query->when(isset($filters['user']), function ($query) use ($filters) { 
            $query->whereHas('user', function ($query) use ($filters) { 
                $query->where('id', $filters['user']); 
            }); 
        });
    }



    // Like
    public function isLikedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }


    // Relationship
    public function category()
    {
        return $this->belongsToMany(Category::class, "post_category", "post_id", "category_id");
    }
    
    public function tag()
    {
        return $this->belongsToMany(Tag::class, "post_tag", "post_id", "tag_id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function saves()
    {
        return $this->belongsToMany(User::class, 'post_saves', 'post_id', 'user_id')->withTimestamps();
    }

    public function savedByUser(User $user)
    {
        return $this->saves()->where('user_id', $user->id)->exists();
    }



    // Slug
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
