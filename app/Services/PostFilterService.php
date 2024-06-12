<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;

class PostFilterService
{
    public function filterPosts(Request $request, $userId = "")
    {
        // Query Builder
        $postsQuery = Post::query();

        if ($userId) {
            $postsQuery->where('user_id', $userId);
        }

        // Filter category query
        $categoryId = $request->query('category');
        if ($categoryId) {
            $postsQuery->where('category_id', $categoryId);
        }

        // Search query
        $search = $request->query('search');
        if ($search) {
            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        return $postsQuery->paginate(5);
    }
}
