<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'isAdmin'];

    protected $fillable = ['category'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
