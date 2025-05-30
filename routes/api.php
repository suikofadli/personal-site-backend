<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Categories API Routes
Route::apiResource('categories', CategoryController::class);

// Articles API Routes
Route::apiResource('articles', ArticleController::class);

// Additional routes for published articles (public access)
Route::get('articles/published', [ArticleController::class, 'index'])
    ->defaults('published', true)
    ->name('articles.published');

Route::get('categories/{category}/articles', function (\Illuminate\Http\Request $request, $categoryId) {
    if (!$request->expectsJson()) {
        return response()->json(['error' => 'Accept application/json header required'], 406);
    }

    $articles = \App\Models\Article::with('category')
        ->where('category_id', $categoryId)
        ->where('is_published', true)
        ->orderBy('published_at', 'desc')
        ->paginate(10);

    return response()->json([
        'success' => true,
        'data' => [
            'data' => \App\Http\Resources\ArticleResource::collection($articles->items()),
            'current_page' => $articles->currentPage(),
            'last_page' => $articles->lastPage(),
            'per_page' => $articles->perPage(),
            'total' => $articles->total(),
        ]
    ]);
})->name('categories.articles');