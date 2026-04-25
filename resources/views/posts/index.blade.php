@extends('layouts.app')

@section('title', 'Mascotas perdidas recientemente · Huellitas Perdidas')

@section('content')
    <div class="hp-container">
        <section class="hp-section">
            <header class="hp-listing-header">
                <div>
                    <h1 class="section-title">Mascotas perdidas recientemente</h1>
                    <p class="section-lead">Revisa los reportes más recientes y ayuda a la comunidad a encontrarlas.</p>
                </div>
            </header>

            <form class="hp-search-bar" method="GET" action="{{ route('posts.index') }}">
                <label class="hp-form-group">
                    <span class="hp-label">Buscar reportes</span>
                    <input class="hp-input" type="search" name="q" value="{{ $query }}" placeholder="Nombre, título o descripción">
                </label>
                <button class="hp-btn hp-btn-primary" type="submit">Buscar</button>
            </form>

            @if ($posts->isEmpty())
                <article class="hp-card hp-empty-state" role="status" aria-live="polite">
                    <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13zm0 2a.75.75 0 0 1 .75.75v3.19l2 1.2a.75.75 0 1 1-.77 1.29L7.56 8.48a.75.75 0 0 1-.31-.62V4.25A.75.75 0 0 1 8 3.5z"/>
                    </svg>
                    <h3>Aún no hay publicaciones disponibles.</h3>
                    <p>Cuando la comunidad comparta reportes, aparecerán aquí.</p>
                </article>
            @else
                <div class="hp-post-grid">
                    @foreach ($posts as $post)
                        @php
                            $pet = $post->pet;
                            $location = $post->location;
                            $photoPath = $post->mainPhoto?->thumbnail_path ?: $post->mainPhoto?->path;
                            $photoUrl = $photoPath ? (str_starts_with($photoPath, 'http') ? $photoPath : asset(str_starts_with($photoPath, 'storage/') ? $photoPath : 'storage/' . ltrim($photoPath, '/'))) : null;
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
                                <h2 class="hp-post-card-title">{{ $pet?->name ?: 'Mascota sin nombre' }}</h2>
                                <p class="hp-post-card-meta">
                                    {{ $pet?->species?->name ?: 'Especie no especificada' }}
                                    @if ($pet?->breed?->name)
                                        · {{ $pet->breed->name }}
                                    @endif
                                </p>
                                <p class="hp-post-card-meta">{{ $location?->label ?: 'Ubicación no especificada' }}</p>
                                <p class="hp-post-card-meta">Publicado {{ optional($post->published_at ?? $post->created_at)->format('d/m/Y') }}</p>
                                <p class="hp-post-card-description">{{ \Illuminate\Support\Str::limit($post->description ?: $post->title, 120) }}</p>

                                <div class="hp-post-card-actions">
                                    <a class="hp-btn hp-btn-primary" href="{{ route('posts.show', $post) }}">Ver publicación</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="hp-pagination">
                    {{ $posts->links() }}
                </div>
            @endif
        </section>
    </div>
@endsection
