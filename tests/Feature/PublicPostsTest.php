<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_without_authentication(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_public_posts_listing_loads_without_authentication(): void
    {
        $this->get(route('posts.index'))->assertOk();
    }

    public function test_public_adoptions_listing_loads_without_authentication(): void
    {
        $this->get(route('adoptions.index'))->assertOk();
    }

    public function test_public_post_detail_loads_for_valid_lost_post(): void
    {
        $post = Post::factory()->create([
            'post_type' => 'lost',
            'status' => 'published',
            'visibility' => 'public',
            'title' => 'Luna se perdió en el parque',
        ]);

        $this->get(route('posts.show', $post))->assertOk();
    }

    public function test_public_adoption_detail_loads_for_valid_adoption_post(): void
    {
        $post = Post::factory()->create([
            'post_type' => 'adoption',
            'status' => 'published',
            'visibility' => 'public',
            'title' => 'Nina busca familia',
        ]);

        $this->get(route('adoptions.show', $post))->assertOk();
    }
}
