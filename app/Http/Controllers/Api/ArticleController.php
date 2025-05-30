<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->expectsJson()) {
                return response()->json(['error' => 'Accept application/json header required'], 406);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::with('category');

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by published status
        if ($request->has('published')) {
            $query->where('is_published', $request->boolean('published'));
        }

        // Search by title or content
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'data' => ArticleResource::collection($articles->items()),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Auto-set published_at if is_published is true and published_at is not set
        if (isset($validated['is_published']) && $validated['is_published'] && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article = Article::create($validated);
        $article->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully',
            'data' => new ArticleResource($article)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load('category');

        return response()->json([
            'success' => true,
            'data' => new ArticleResource($article)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Auto-set published_at if is_published is true and published_at is not set
        if (isset($validated['is_published']) && $validated['is_published'] && !$article->published_at && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);
        $article->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => new ArticleResource($article)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully'
        ]);
    }
}
