<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $author_id
 * @property int $category_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $likes_count
 * @property int $dislikes_count
 * @property int $comments_count
 * @property Collection $tags
 * @property $category;
 * @property $author;
 * @property $comments;
 */
class Post extends Model
{
    use HasFactory;

    public function likes(): HasMany
    {
        return $this->hasMany(PostVote::class)->where(['vote' => PostVote::VOTE_LIKE]);
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(PostVote::class)->where(['vote' => PostVote::VOTE_DISLIKE]);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
