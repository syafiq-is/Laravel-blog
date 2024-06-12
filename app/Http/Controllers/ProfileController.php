<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Services\PostFilterService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $postFilterService;

    public function __construct(PostFilterService $postFilterService)
    {
        $this->postFilterService = $postFilterService;
    }

    public function index(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $posts = $this->postFilterService->filterPosts($request, $userId);
        $categories = Category::all();

        $displayCategory = $request->query('category') ? Category::find($request->query('category'))->category : 'All';

        return view('profile', [
            'user' => $user,
            'posts' => $posts,
            'categories' => $categories,
            'displayCategory' => $displayCategory
        ]);
    }

    // Profile Edit Page
    public function edit($userId)
    {
        $user = User::findOrfail($userId);

        return view('profile-edit', ['user' => $user]);
    }
}
