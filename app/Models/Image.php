<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image_url', 'price'
    ];

    protected $casts = [
      'image_url' => 'array'
    ];
//    public function user()
//    {
//        return $this->belongsToMany(User::class, 'user_id')->withDefault();
//    }
//    public function imagerepository()
//    {
//        return $this->belongsTo(ImageRepository::class, 'image_repository_id');
//    }
}
