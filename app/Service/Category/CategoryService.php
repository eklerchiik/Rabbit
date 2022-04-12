<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\DTO\Category\CategoryDTOFactory;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    private bool $shouldLog;
    private CategoryDTOFactory $categoryDTOFactory;

    public function __construct(bool $shouldLog, CategoryDTOFactory $categoryDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->categoryDTOFactory = $categoryDTOFactory;
    }

    public function createCategory(string $title): string
    {
        $category = new Category();

        $category->title = $title;

        $category->save();

        if ($this->shouldLog) {
            Log::info('Category was created: ' . $category->id);
        }

        return $category->title;
    }

    public function getCategories(): array
    {
        return $this->categoryDTOFactory->buildFromModelCollection(Category::all());
    }

    public function updateCategory(Category $category, string $title): void
    {
        $category->title = $title;

        $category->save();

        if ($this->shouldLog) {
            Log::info('Category was updated: ' . $category->id);
        }
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();

        if ($this->shouldLog) {
            Log::info('Category was deleted: ' . $category->id);
        }
    }
}
