<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Service\Category\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function createCategory(CreateCategoryRequest $request, CategoryService $categoryService): JsonResponse
    {
        $categoryService->createCategory($request->get('title'));

        return response()->json([
            'success' => true
        ]);
    }

    public function getCategories(CategoryService $categoryService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $categoryService->getCategories()
        ]);
    }

    public function updateCategory(
        Category $category,
        UpdateCategoryRequest $request,
        CategoryService $categoryService
    ): JsonResponse
    {
        $categoryService->updateCategory($category, $request->get('title'));

        return response()->json([
            'success' => true
        ]);
    }

    public function deleteCategory(Category $category, CategoryService $categoryService): JsonResponse
    {
        $categoryService->deleteCategory($category);

        return response()->json([
            'success' => true
        ]);
    }
}
