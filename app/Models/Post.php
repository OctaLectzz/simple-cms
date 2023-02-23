<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;


    protected $guarded = [
        'id'
    ];

    protected $attributes =[
        'created_by' => '',
        'postImages' => '',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];



    public function category()
    {
        return $this->belongsToMany(Category::class, "post_category", "post_id", "category_id");
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class, "post_tag", "post_id", "tag_id");
    }



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    public function scopeFilter($query, array $filters)
    {
        // Category Search //
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });


        // User Search //
        $query->when($filters['user'] ?? false, fn($query, $user) =>
            $query->whereHas('user', fn($query)=>
                $query->where('username', $user)
            )
        );
    }
}
