<?php

declare(strict_types=1);

namespace App\DTO\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryDTOFactory
{
    public function buildFromModel(Category $category): CategoryDTO
    {
        return new CategoryDTO(
            $category->title,
            $category->id
        );
    }

    public function buildFromModelCollection(Collection $categories): array
    {
        $categoryDTOs = [];

        foreach ($categories as $category) {
            $categoryDTOs[] = $this->buildFromModel($category);
        }

        return $categoryDTOs;
    }
}
