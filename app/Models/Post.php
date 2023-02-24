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
                $query->where('id', $category);
            });
        });


        // User Search //
        // $query->when($filters['created_by'] ?? false, fn($query, $created_by) =>
        //     $query->whereHas('created_by', fn($query)=>
        //         $query->where('id', $created_by)
        //     )
        // );
    }



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



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
