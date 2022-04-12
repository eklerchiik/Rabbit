<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property string $text
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $likes_count
 * @property int $dislikes_count
 * @property $author
 */
class Comment extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'NEW';
    public const STATUS_SPAM = 'SPAM';
    public const STATUS_VERIFIED = 'VERIFIED';

    public function likes(): HasMany
    {
        return $this->hasMany(Vote::class)->where(['vote' => Vote::VOTE_LIKE]);
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(Vote::class)->where(['vote' => Vote::VOTE_DISLIKE]);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
