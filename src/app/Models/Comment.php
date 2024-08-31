<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','item_id','content'];

    public Function user()
    {
        return $this->belongsTo(User::class);
    }


    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
