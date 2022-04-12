<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $user_id
 * @property int $comment_id
 * @property string $vote
 **/

class Vote extends Model
{
    use HasFactory;

    public const VOTE_LIKE = 'LIKE';
    public const VOTE_DISLIKE = 'DISLIKE';

    public $timestamps = false;

    protected $fillable = ['user_id', 'comment_id', 'vote'];
}
