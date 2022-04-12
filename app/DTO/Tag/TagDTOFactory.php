<?php

declare(strict_types=1);

namespace App\DTO\Tag;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagDTOFactory
{
    public function buildFromModel(Tag $tag): TagDTO
    {
        return new TagDTO(
            $tag->title,
            $tag->id
        );
    }

    public function buildFromModelCollection(Collection $tags): array
    {
        $tagDTOs = [];

        foreach ($tags as $tag) {
            $tagDTOs[] = $this->buildFromModel($tag);
        }

        return $tagDTOs;
    }
}
