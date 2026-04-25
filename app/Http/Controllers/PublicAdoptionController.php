<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PublicAdoptionController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));

        $posts = $this->baseQuery()
            ->adoption()
            ->when($query !== '', function (Builder $builder) use ($query): void {
                $builder->where(function (Builder $scoped) use ($query): void {
                    $scoped->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhereHas('pet', function (Builder $petQuery) use ($query): void {
                            $petQuery->where('name', 'like', "%{$query}%");
                        });
                });
            })
            ->paginate(12)
            ->withQueryString();

        return view('adoptions.index', [
            'posts' => $posts,
            'query' => $query,
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->isPublished() && $post->visibility === 'public' && $post->isAdoption(), 404);

        $post->load(['pet.species', 'pet.breed', 'pet.mainColor', 'location', 'mainPhoto', 'photos', 'author']);

        return view('adoptions.show', compact('post'));
    }

    protected function baseQuery(): Builder
    {
        return Post::query()
            ->with(['pet.species', 'pet.breed', 'pet.mainColor', 'location', 'mainPhoto', 'author'])
            ->published()
            ->visiblePublic()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');
    }
}
