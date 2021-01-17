<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageRepository extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function image(){
        return $this->hasMany(Image::class);
    }
}
