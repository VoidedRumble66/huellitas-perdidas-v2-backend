<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully_for_guests(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
    }

    public function test_home_page_shows_main_title_and_recent_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Reporta, busca y ayuda a reunir mascotas con sus familias');
        $response->assertSee('Mascotas perdidas recientemente');
        $response->assertSee('Mascotas en adopción recientemente');
    }

    public function test_home_page_renders_empty_states_when_there_are_no_posts(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('No hay mascotas perdidas publicadas por ahora.');
        $response->assertSee('No hay mascotas en adopción por ahora.');
    }
}
