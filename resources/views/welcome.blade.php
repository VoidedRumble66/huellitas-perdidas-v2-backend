@extends('layouts.app')

@section('title', 'Huellitas Perdidas · Inicio')

@section('content')
    @php
        $lostPosts = $lostPosts ?? collect();
        $adoptionPosts = $adoptionPosts ?? collect();

        $lostListUrl = Route::has('posts.lost.index')
            ? route('posts.lost.index')
            : (Route::has('posts.index') ? route('posts.index', ['type' => 'lost']) : '#');

        $adoptionListUrl = Route::has('posts.adoption.index')
            ? route('posts.adoption.index')
            : (Route::has('adoptions.index') ? route('adoptions.index') : '#');
    @endphp

    <div class="hp-container">
        <section class="hp-section hp-hero">
            <div class="hp-hero-grid">
                <div>
                    <div class="hp-brand">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo de Huellitas Perdidas"
                            class="hp-logo-img"
                            onerror="this.classList.add('hp-hidden'); this.nextElementSibling.classList.remove('hp-hidden');"
                        >
                        <span class="hp-logo-fallback hp-hidden" aria-hidden="true">HP</span>
                        <span class="hp-badge hp-badge-lime">Comunidad activa</span>
                    </div>

                    <h1 class="hp-hero-title">Reporta, busca y ayuda a reunir mascotas con sus familias</h1>
                    <p class="hp-lead">Una plataforma comunitaria para mascotas perdidas, encontradas y en adopción en Ocosingo, Chiapas.</p>

                    <div class="hp-actions-row">
                        <a class="hp-btn hp-btn-primary" href="{{ Route::has('posts.index') ? route('posts.index') : "#" }}">Ver publicaciones</a>
                        <a class="hp-btn hp-btn-outline" href="{{ Route::has('adoptions.index') ? route('adoptions.index') : "#" }}">Ver adopciones</a>
                    </div>

                    <p class="hp-pwa-note">También podrás instalar Huellitas en tu celular como acceso tipo app.</p>
                </div>

                <aside class="hp-hero-panel" aria-label="Datos de confianza">
                    <article class="hp-stat">
                        <strong>Reportes colaborativos</strong>
                        <p class="hp-lead">Vecinos, refugios y veterinarias ayudan a difundir casos con evidencia útil.</p>
                    </article>
                    <article class="hp-stat">
                        <strong>Seguimiento visible</strong>
                        <p class="hp-lead">Estados y actividad comunitaria para mejorar cada búsqueda.</p>
                    </article>
                    <article class="hp-stat">
                        <strong>Web + PWA</strong>
                        <p class="hp-lead">Acceso rápido desde navegador o instalación en pantalla de inicio.</p>
                    </article>
                </aside>
            </div>
        </section>

        <section class="hp-section" id="publicaciones-recientes">
            <div class="hp-section-head">
                <div>
                    <h2 class="section-title">Mascotas perdidas recientemente</h2>
                    <p class="section-lead">Comparte o revisa los últimos reportes de la comunidad.</p>
                </div>
                <a class="hp-btn hp-btn-outline" href="{{ $lostListUrl }}">Ver todas</a>
            </div>

            @if ($lostPosts->isEmpty())
                <article class="hp-card hp-empty-state" role="status" aria-live="polite">
                    <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13zm0 2a.75.75 0 0 1 .75.75v3.19l2 1.2a.75.75 0 1 1-.77 1.29L7.56 8.48a.75.75 0 0 1-.31-.62V4.25A.75.75 0 0 1 8 3.5z"/>
                    </svg>
                    <h3>No hay mascotas perdidas publicadas por ahora.</h3>
                    <p>Cuando la comunidad publique reportes, aparecerán aquí.</p>
                </article>
            @else
                <div class="hp-post-grid">
                    @foreach ($lostPosts as $post)
                        @php
                            $pet = $post->pet;
                            $location = $post->location;
                            $photoPath = $post->mainPhoto?->thumbnail_path ?: $post->mainPhoto?->path;
                            $photoUrl = $photoPath ? (str_starts_with($photoPath, 'http') ? $photoPath : asset(str_starts_with($photoPath, 'storage/') ? $photoPath : 'storage/' . ltrim($photoPath, '/'))) : null;
                            $postUrl = Route::has('posts.show') ? route('posts.show', $post) : '#';
                            $sightingUrl = Route::has('sightings.create') ? route('sightings.create', ['post' => $post->id]) : '#';
                        @endphp

                        <article class="hp-post-card hp-card">
                            <div class="hp-post-card-image">
                                @if ($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="Foto de {{ $pet?->name ?: 'mascota reportada' }}" loading="lazy">
                                @else
                                    <div class="hp-post-card-image-placeholder">Sin imagen</div>
                                @endif
                                <span class="hp-badge hp-badge-orange">Perdida</span>
                            </div>

                            <div class="hp-post-card-body">
                                <h3 class="hp-post-card-title">{{ $pet?->name ?: 'Mascota sin nombre' }}</h3>
                                <p class="hp-post-card-meta">
                                    {{ $pet?->species?->name ?: 'Especie no especificada' }}
                                    @if ($pet?->breed?->name)
                                        · {{ $pet->breed->name }}
                                    @endif
                                </p>
                                <p class="hp-post-card-meta">{{ $location?->label ?: 'Ubicación no especificada' }}</p>
                                <p class="hp-post-card-description">{{ \Illuminate\Support\Str::limit($post->description ?: $post->title, 100) }}</p>

                                <div class="hp-post-card-actions">
                                    <a class="hp-btn hp-btn-outline" href="{{ $postUrl }}">Ver publicación</a>
                                    <a class="hp-btn hp-btn-primary" href="{{ $sightingUrl }}">Reportar avistamiento</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="hp-section">
            <div class="hp-section-head">
                <div>
                    <h2 class="section-title">Mascotas en adopción recientemente</h2>
                    <p class="section-lead">Conoce mascotas que buscan una familia responsable.</p>
                </div>
                <a class="hp-btn hp-btn-outline" href="{{ $adoptionListUrl }}">Ver todas</a>
            </div>

            @if ($adoptionPosts->isEmpty())
                <article class="hp-card hp-empty-state" role="status" aria-live="polite">
                    <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path d="M8 1a4.5 4.5 0 0 1 4.5 4.5c0 1.15-.44 2.2-1.16 2.99l2.1 2.1a.75.75 0 0 1-1.06 1.06l-2.1-2.1A4.48 4.48 0 0 1 8 10a4.5 4.5 0 1 1 0-9zm0 1.5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM3.5 12a2.5 2.5 0 0 1 4.98 0h-1.5a1 1 0 0 0-1.98 0H3.5zm5.5.75h3.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"/>
                    </svg>
                    <h3>No hay mascotas en adopción por ahora.</h3>
                    <p>Cuando existan publicaciones aprobadas, aparecerán aquí.</p>
                </article>
            @else
                <div class="hp-post-grid">
                    @foreach ($adoptionPosts as $post)
                        @php
                            $pet = $post->pet;
                            $location = $post->location;
                            $photoPath = $post->mainPhoto?->thumbnail_path ?: $post->mainPhoto?->path;
                            $photoUrl = $photoPath ? (str_starts_with($photoPath, 'http') ? $photoPath : asset(str_starts_with($photoPath, 'storage/') ? $photoPath : 'storage/' . ltrim($photoPath, '/'))) : null;
                            $postUrl = Route::has('posts.show') ? route('posts.show', $post) : '#';
                            $adoptionUrl = Route::has('adoptions.show') ? route('adoptions.show', $post) : $postUrl;
                        @endphp

                        <article class="hp-post-card hp-card">
                            <div class="hp-post-card-image">
                                @if ($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="Foto de {{ $pet?->name ?: 'mascota en adopción' }}" loading="lazy">
                                @else
                                    <div class="hp-post-card-image-placeholder">Sin imagen</div>
                                @endif
                                <span class="hp-badge hp-badge-lime">Adopción</span>
                            </div>

                            <div class="hp-post-card-body">
                                <h3 class="hp-post-card-title">{{ $pet?->name ?: 'Mascota sin nombre' }}</h3>
                                <p class="hp-post-card-meta">
                                    {{ $pet?->species?->name ?: 'Especie no especificada' }}
                                    @if ($pet?->breed?->name)
                                        · {{ $pet->breed->name }}
                                    @endif
                                </p>
                                <p class="hp-post-card-meta">{{ $location?->label ?: 'Ubicación no especificada' }}</p>
                                <p class="hp-post-card-description">{{ \Illuminate\Support\Str::limit($post->description ?: $post->title, 100) }}</p>

                                <div class="hp-post-card-actions">
                                    <a class="hp-btn hp-btn-outline" href="{{ $postUrl }}">Ver publicación</a>
                                    <a class="hp-btn hp-btn-primary" href="{{ $adoptionUrl }}">Ver adopción</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="hp-section" id="cta-comunidad">
            <div class="hp-alert hp-cta-panel">
                <h2 class="section-title">Cada reporte puede acercar una mascota a casa.</h2>
                <p class="section-lead">Tu publicación puede ser la diferencia entre perder una pista o reencontrar una familia.</p>
                <div class="hp-actions-row">
                    <a href="{{ $lostListUrl }}" class="hp-btn hp-btn-primary">Comenzar ahora</a>
                </div>
            </div>
        </section>
    </div>
@endsection
