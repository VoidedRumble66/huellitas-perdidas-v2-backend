@extends('layouts.app')

@section('title', 'Mascotas en adopción · Huellitas Perdidas')

@section('content')
    <div class="hp-container">
        <section class="hp-section">
            <header class="hp-listing-header">
                <div>
                    <h1 class="section-title">Mascotas en adopción</h1>
                    <p class="section-lead">Conoce mascotas que buscan una familia responsable y amorosa.</p>
                </div>
            </header>

            <form class="hp-search-bar" method="GET" action="{{ route('adoptions.index') }}">
                <label class="hp-form-group">
                    <span class="hp-label">Buscar adopciones</span>
                    <input class="hp-input" type="search" name="q" value="{{ $query }}" placeholder="Nombre, título o descripción">
                </label>
                <button class="hp-btn hp-btn-primary" type="submit">Buscar</button>
            </form>

            @if ($posts->isEmpty())
                <article class="hp-card hp-empty-state" role="status" aria-live="polite">
                    <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path d="M8 1a4.5 4.5 0 0 1 4.5 4.5c0 1.15-.44 2.2-1.16 2.99l2.1 2.1a.75.75 0 0 1-1.06 1.06l-2.1-2.1A4.48 4.48 0 0 1 8 10a4.5 4.5 0 1 1 0-9zm0 1.5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM3.5 12a2.5 2.5 0 0 1 4.98 0h-1.5a1 1 0 0 0-1.98 0H3.5zm5.5.75h3.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"/>
                    </svg>
                    <h3>Aún no hay mascotas en adopción publicadas.</h3>
                    <p>Cuando existan publicaciones disponibles, aparecerán aquí.</p>
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
                                    <img src="{{ $photoUrl }}" alt="Foto de {{ $pet?->name ?: 'mascota en adopción' }}" loading="lazy">
                                @else
                                    <div class="hp-post-card-image-placeholder">Sin imagen</div>
                                @endif
                                <span class="hp-badge hp-badge-lime">Adopción</span>
                            </div>

                            <div class="hp-post-card-body">
                                <h2 class="hp-post-card-title">{{ $pet?->name ?: 'Mascota sin nombre' }}</h2>
                                <p class="hp-post-card-meta">
                                    {{ $pet?->species?->name ?: 'Especie no especificada' }}
                                    @if ($pet?->breed?->name)
                                        · {{ $pet->breed->name }}
                                    @endif
                                </p>
                                @if ($pet?->sex || $pet?->approximate_age)
                                    <p class="hp-post-card-meta">
                                        {{ $pet?->sex ?: 'Sexo no especificado' }}
                                        @if ($pet?->approximate_age)
                                            · {{ $pet->approximate_age }}
                                        @endif
                                    </p>
                                @endif
                                <p class="hp-post-card-meta">{{ $location?->label ?: 'Ubicación no especificada' }}</p>
                                <p class="hp-post-card-description">{{ \Illuminate\Support\Str::limit($post->description ?: $post->title, 120) }}</p>

                                <div class="hp-post-card-actions">
                                    <a class="hp-btn hp-btn-primary" href="{{ route('adoptions.show', $post) }}">Ver adopción</a>
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
