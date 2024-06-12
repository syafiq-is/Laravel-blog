<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getPost($postId)
    {
        $post = Post::findOrFail($postId);
        $user = $post->user;

        return view('post', ['post' => $post, 'user' => $user]);
    }

    public function getPostEdit($postId)
    {
        $post = Post::findOrFail($postId);
        $user = $post->user;

        $this->authorize('post.edit', $post, $user);

        $categories = Category::all();

        return view('post-edit', ['post' => $post, 'user' => $user, 'categories' => $categories]);
    }

    public function createPostPage()
    {
        $categories = Category::all();

        return view('post-create', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required|string',
            'content' => 'required|string',
            'cover_img' => 'image',
        ]);

        if (request()->has('cover_img')) {
            // Store to storage in storage
            $imgPath = request()->file('cover_img')->store('post', 'public');
            $validatedData['cover_img'] = $imgPath;
        }

        Post::create($validatedData);

        return redirect(route('profile', ['userId' => $request->input('user_id')]));
    }

    public function update(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string',
            'content' => 'required|string',
            'cover_img' => 'image',
        ]);

        if (request()->has('cover_img')) {
            // Store to storage in storage/post
            $imgPath = request()->file('cover_img')->store('post', 'public');
            $validatedData['cover_img'] = $imgPath;

            // Delete previous image
            Storage::disk('public')->delete($post->cover_img);
        }

        $post->update($validatedData);

        return redirect(route('post', ['postId' => $post->id]));
    }

    public function delete($postId)
    {
        $post = Post::findOrFail($postId);

        $post->delete();

        return redirect(route('profile', ['userId' => $post->user_id]));
    }
}
