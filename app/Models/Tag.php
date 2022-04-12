<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 **/

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

}
