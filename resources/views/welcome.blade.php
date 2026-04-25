@extends('layouts.app')

@section('title', 'Huellitas Perdidas · Comunidad que encuentra')

@section('content')
    <div class="container">
        <section class="hero section">
            <div class="hero-grid">
                <div>
                    <span class="chip chip-lime">PWA instalable · Mobile first</span>
                    <h1>Juntos hacemos que más huellitas regresen a casa.</h1>
                    <p>
                        Publica casos de mascotas perdidas, encontradas y en adopción en minutos.
                        Conecta con vecinos, refugios y veterinarias desde una experiencia web rápida, amigable y lista para instalar en tu celular.
                    </p>
                    <div style="display:flex; gap:.65rem; flex-wrap:wrap;">
                        <a class="btn btn-primary btn-lg" href="#publicaciones">Reportar mascota</a>
                        <a class="btn btn-outline btn-lg" href="#categorias">Ver publicaciones</a>
                    </div>
                </div>
                <aside class="hero-art" aria-label="Resumen de comunidad">
                    <article class="hero-stat">
                        <strong>+2,300</strong>
                        <p>Reportes comunitarios gestionados de forma colaborativa.</p>
                    </article>
                    <article class="hero-stat">
                        <strong>Seguimiento activo</strong>
                        <p>Estado visible de casos para mejorar búsquedas y adopciones.</p>
                    </article>
                    <article class="hero-stat">
                        <strong>Web + PWA</strong>
                        <p>Acceso desde navegador y experiencia instalable en móvil.</p>
                    </article>
                </aside>
            </div>
        </section>

        <section class="section" id="categorias">
            <h2 class="section-title">Accesos rápidos</h2>
            <p class="section-lead">Encuentra lo que necesitas con bloques claros y estados visuales consistentes.</p>
            <div class="grid-cards cols-4" style="margin-top:1rem;">
                <article class="card status-lost">
                    <h3>Mascotas perdidas</h3>
                    <p>Casos recientes, zonas y características para acelerar el reencuentro.</p>
                </article>
                <article class="card status-found">
                    <h3>Mascotas encontradas</h3>
                    <p>Publicaciones de apoyo comunitario para validar coincidencias rápidamente.</p>
                </article>
                <article class="card status-adoption" id="adopciones">
                    <h3>Adopciones</h3>
                    <p>Historias y perfiles para conectar hogares responsables con refugios.</p>
                </article>
                <article class="card" id="refugios">
                    <h3>Refugios / Veterinarias</h3>
                    <p>Aliados confiables para atención, tránsito, rescate y seguimiento.</p>
                </article>
            </div>
        </section>

        <section class="section" id="publicaciones">
            <h2 class="section-title">¿Cómo funciona?</h2>
            <p class="section-lead">Un flujo simple y humano para que reportar, compartir y ayudar sea más fácil.</p>
            <div class="grid-cards cols-3" style="margin-top:1rem;">
                <article class="card">
                    <span class="chip chip-warning">1 · Publica</span>
                    <h3>Comparte datos clave</h3>
                    <p>Nombre, foto, ubicación y detalles para que la comunidad reconozca a la mascota.</p>
                </article>
                <article class="card">
                    <span class="chip chip-lime">2 · Comparte</span>
                    <h3>Difunde en minutos</h3>
                    <p>Expande el alcance con enlaces directos y recursos visuales listos para compartir.</p>
                </article>
                <article class="card">
                    <span class="chip chip-danger">3 · Encuentra / Ayuda</span>
                    <h3>Da seguimiento al caso</h3>
                    <p>Reporta avistamientos, comenta evidencia y actualiza el estado del caso.</p>
                </article>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Confianza de comunidad</h2>
            <p class="section-lead">Moderación, trazabilidad y enfoque colaborativo para decisiones más seguras.</p>
            <div class="grid-cards" style="margin-top:1rem;">
                <article class="card">
                    <h3>Comunidad activa</h3>
                    <p>Personas, organizaciones y profesionales participan en la visibilidad de cada caso.</p>
                </article>
                <article class="card">
                    <h3>Reportes y moderación</h3>
                    <p>Herramientas de reporte para cuidar calidad de contenido y seguridad del espacio.</p>
                </article>
                <article class="card">
                    <h3>Seguimiento transparente</h3>
                    <p>Historial de cambios y estados para saber qué pasó en cada publicación.</p>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="alert alert-info">
                <h2 class="section-title" style="margin-bottom:.4rem;">¿Listo para ayudar a una huellita hoy?</h2>
                <p class="section-lead" style="margin-bottom:1rem;">Publica un caso, comparte con tu comunidad y construyamos juntos una red de apoyo real.</p>
                <div style="display:flex; flex-wrap:wrap; gap:.6rem;">
                    <a href="#publicaciones" class="btn btn-primary">Comenzar ahora</a>
                    <a href="#ayuda" class="btn btn-secondary">Conocer aliados</a>
                </div>
            </div>
        </section>
    </div>
@endsection
