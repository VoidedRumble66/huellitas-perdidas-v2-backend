<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $relations = ['pet.species', 'pet.breed', 'pet.mainColor', 'location', 'mainPhoto', 'photos', 'author'];

        $lostPosts = Post::query()
            ->with($relations)
            ->published()
            ->visiblePublic()
            ->lost()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $adoptionPosts = Post::query()
            ->with($relations)
            ->published()
            ->visiblePublic()
            ->adoption()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('welcome', compact('lostPosts', 'adoptionPosts'));
    }
}
