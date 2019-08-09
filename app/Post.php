<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'content', 'image'];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }
}
