<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthPostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedPostId = $request->route('postId');
        $post = Post::find($requestedPostId);

        if (!$post) {
            abort(404, 'Post not found');
        }
        $requestedPostOwnerId = $post->user_id;
        $authenticatedPostOwnerId = auth()->id();

        if ($requestedPostOwnerId !== $authenticatedPostOwnerId) {
            abort(403, 'Unauthorized access');
        }
        return $next($request);
    }
}
