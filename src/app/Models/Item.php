<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'name',
        'item_image',
        'price',
        'description',
        'condition',
        'category_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function likers()
    {
        return $this->belongsToMany(User::class,'likes');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function purchasers()
    {
        return $this->hasMany('Purchase::class');
    }
}
