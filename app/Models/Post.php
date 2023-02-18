<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'images',
        'title',
        'content',
    ];


    protected $attributes =[
        'created_by' => '',
        'images' => '',
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
