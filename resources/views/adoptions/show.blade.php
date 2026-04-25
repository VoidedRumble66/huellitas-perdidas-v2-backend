@extends('layouts.app')

@section('title', ($post->pet?->name ?: 'Adopción') . ' · Huellitas Perdidas')

@section('content')
    @php
        $pet = $post->pet;
        $location = $post->location;
        $publishedAt = $post->published_at ?? $post->created_at;
        $mainPhotoPath = $post->mainPhoto?->thumbnail_path ?: $post->mainPhoto?->path;
        $mainPhotoUrl = $mainPhotoPath ? (str_starts_with($mainPhotoPath, 'http') ? $mainPhotoPath : asset(str_starts_with($mainPhotoPath, 'storage/') ? $mainPhotoPath : 'storage/' . ltrim($mainPhotoPath, '/'))) : null;
    @endphp

    <div class="hp-container">
        <section class="hp-section hp-detail-layout">
            <article class="hp-detail-main hp-card">
                <div class="hp-detail-gallery">
                    @if ($mainPhotoUrl)
                        <img src="{{ $mainPhotoUrl }}" alt="Foto principal de {{ $pet?->name ?: 'mascota en adopción' }}" loading="eager">
                    @else
                        <div class="hp-post-card-image-placeholder hp-detail-no-image">Sin imagen</div>
                    @endif

                    @if ($post->photos->isNotEmpty())
                        <div class="hp-detail-gallery-strip">
                            @foreach ($post->photos->take(4) as $photo)
                                @php
                                    $path = $photo->thumbnail_path ?: $photo->path;
                                    $url = $path ? (str_starts_with($path, 'http') ? $path : asset(str_starts_with($path, 'storage/') ? $path : 'storage/' . ltrim($path, '/'))) : null;
                                @endphp
                                <div class="hp-detail-gallery-thumb">
                                    @if ($url)
                                        <img src="{{ $url }}" alt="Foto adicional {{ $loop->iteration }}" loading="lazy">
                                    @else
                                        <span>Sin imagen</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <h1 class="section-title">{{ $pet?->name ?: 'Mascota sin nombre' }}</h1>
                <p class="hp-post-card-meta">Publicación de adopción · Estado: {{ ucfirst($post->status) }}</p>
                <p class="hp-post-card-meta">Publicado el {{ optional($publishedAt)->format('d/m/Y H:i') }}</p>

                <div class="hp-detail-meta-grid">
                    <p><strong>Especie:</strong> {{ $pet?->species?->name ?: 'No especificada' }}</p>
                    <p><strong>Raza:</strong> {{ $pet?->breed?->name ?: 'No especificada' }}</p>
                    <p><strong>Color principal:</strong> {{ $pet?->mainColor?->name ?: 'No especificado' }}</p>
                    <p><strong>Sexo:</strong> {{ $pet?->sex ?: 'No especificado' }}</p>
                    <p><strong>Edad aproximada:</strong> {{ $pet?->approximate_age ?: 'No especificada' }}</p>
                    <p><strong>Ubicación:</strong> {{ $location?->label ?: 'No especificada' }}</p>
                </div>

                <h2>Descripción</h2>
                <p>{{ $post->description ?: 'Sin descripción disponible.' }}</p>
            </article>

            <aside class="hp-detail-sidebar hp-card">
                <h2>Acciones</h2>
                <div class="hp-post-card-actions">
                    <a class="hp-btn hp-btn-outline" href="#">Compartir</a>
                    <a class="hp-btn hp-btn-primary" href="#">Me interesa adoptar</a>
                    <a class="hp-btn hp-btn-outline" href="#">Contactar</a>
                </div>
                <p class="hp-post-card-meta">Estas acciones avanzadas se conectarán en fases siguientes.</p>
                <a class="hp-btn hp-btn-outline" href="{{ route('adoptions.index') }}">Volver a adopciones</a>
            </aside>
        </section>
    </div>
@endsection
