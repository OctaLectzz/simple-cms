<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


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
}
