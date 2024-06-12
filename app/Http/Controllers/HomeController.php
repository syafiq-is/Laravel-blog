<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\PostFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $postFilterService;

    public function __construct(PostFilterService $postFilterService)
    {
        $this->postFilterService = $postFilterService;
    }

    public function index(Request $request)
    {
        $posts = $this->postFilterService->filterPosts($request);
        $categories = Category::all();

        $displayCategory = $request->query('category') ? Category::find($request->query('category'))->category : 'All';

        if (Auth::check()) {
            return view('index', [
                'posts' => $posts,
                'categories' => $categories,
                'displayCategory' => $displayCategory
            ]);
        }

        return view('guest.index', [
            'posts' => $posts,
            'categories' => $categories,
            'displayCategory' => $displayCategory
        ]);
    }
}
