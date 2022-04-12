<?php

declare(strict_types=1);

namespace App\Service\Tag;

use App\DTO\Tag\TagDTOFactory;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class TagService
{
    private bool $shouldLog;
    private TagDTOFactory $tagDTOFactory;

    public function __construct(bool $shouldLog, TagDTOFactory $tagDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->tagDTOFactory = $tagDTOFactory;
    }

    public function createTag(string $title): string
    {
        $tag = new Tag();

        $tag->title = $title;

        $tag->save();

        if ($this->shouldLog) {
            Log::info('Tag was created: ' . $tag->id);
        }

        return $tag->title;
    }

    public function getTags(): array
    {
        return $this->tagDTOFactory->buildFromModelCollection(Tag::all());
    }

    public function updateTag(Tag $tag, string $title): void
    {
        $tag->title = $title;

        $tag->save();

        if ($this->shouldLog) {
            Log::info('Tag was updated: ' . $tag->id);
        }
    }

    public function deleteTag(Tag $tag): void
    {
        $tag->delete();

        if ($this->shouldLog) {
            Log::info('Tag was deleted: ' . $tag->id);
        }
    }
}
