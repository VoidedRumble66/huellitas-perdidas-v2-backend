@extends('layouts.app')

@section('title', 'Huellitas Perdidas · Inicio')

@section('content')
    <div class="hp-container">
        <section class="hp-section hp-hero">
            <div class="hp-hero-grid">
                <div>
                    <div class="hp-brand">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo de Huellitas Perdidas"
                            class="hp-logo"
                            onerror="this.classList.add('hp-hidden'); this.nextElementSibling.classList.remove('hp-hidden');"
                        >
                        <span class="hp-logo-fallback hp-hidden" aria-hidden="true">HP</span>
                        <span class="hp-badge hp-badge-lime">Comunidad activa</span>
                    </div>

                    <h1 class="hp-hero-title">Reporta, busca y ayuda a reunir mascotas con sus familias</h1>
                    <p class="hp-lead">Una plataforma comunitaria para mascotas perdidas, encontradas y en adopción en Ocosingo, Chiapas.</p>

                    <div class="hp-actions-row">
                        <a class="hp-btn hp-btn-primary" href="#publicaciones">Reportar mascota</a>
                        <a class="hp-btn hp-btn-outline" href="#publicaciones">Ver publicaciones</a>
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

        <section class="hp-section" id="publicaciones">
            <h2 class="section-title">Acciones rápidas</h2>
            <p class="section-lead">Accede al flujo adecuado según el tipo de caso.</p>
            <div class="hp-grid cols-4 hp-mt-1">
                <article class="hp-card hp-card-hover hp-feature-card">
                    <h3>Mascotas perdidas</h3>
                    <p class="hp-lead">Publica ubicación, foto y rasgos para activar la red local.</p>
                </article>
                <article class="hp-card hp-card-hover hp-feature-card">
                    <h3>Mascotas encontradas</h3>
                    <p class="hp-lead">Comparte hallazgos y ayuda a identificar familias rápidamente.</p>
                </article>
                <article class="hp-card hp-card-hover hp-feature-card" id="adopciones">
                    <h3>Adopciones</h3>
                    <p class="hp-lead">Conecta hogares responsables con mascotas que buscan familia.</p>
                </article>
                <article class="hp-card hp-card-hover hp-feature-card" id="refugios">
                    <h3>Refugios y veterinarias</h3>
                    <p class="hp-lead">Encuentra aliados para atención, rescate y seguimiento.</p>
                </article>
            </div>
        </section>

        <section class="hp-section hp-section-muted">
            <div class="hp-container">
                <h2 class="section-title">Cómo funciona</h2>
                <p class="section-lead">Un flujo simple para movilizar a la comunidad en minutos.</p>
                <div class="hp-grid cols-3 hp-mt-1">
                    <article class="hp-card">
                        <span class="hp-badge hp-badge-orange">Paso 1</span>
                        <h3>Publica el reporte</h3>
                        <p class="hp-lead">Completa datos clave para que la mascota pueda ser reconocida.</p>
                    </article>
                    <article class="hp-card">
                        <span class="hp-badge hp-badge-lime">Paso 2</span>
                        <h3>Comparte con la comunidad</h3>
                        <p class="hp-lead">Difunde el caso para aumentar alcance local y regional.</p>
                    </article>
                    <article class="hp-card">
                        <span class="hp-badge hp-badge-info">Paso 3</span>
                        <h3>Da seguimiento al caso</h3>
                        <p class="hp-lead">Registra avistamientos, comentarios y cambios de estado.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="hp-section" id="confianza">
            <h2 class="section-title">Confianza y comunidad</h2>
            <p class="section-lead">Herramientas que fortalecen la colaboración y la calidad de la información.</p>
            <div class="hp-grid cols-4 hp-mt-1">
                <article class="hp-card hp-card-hover">
                    <h3>Reportes con ubicación</h3>
                    <p class="hp-lead">Puntos de referencia para búsquedas más efectivas.</p>
                </article>
                <article class="hp-card hp-card-hover">
                    <h3>Comentarios y avistamientos</h3>
                    <p class="hp-lead">Contribuciones ciudadanas para validar coincidencias.</p>
                </article>
                <article class="hp-card hp-card-hover">
                    <h3>Moderación y reportes</h3>
                    <p class="hp-lead">Mecanismos para mantener seguridad y calidad comunitaria.</p>
                </article>
                <article class="hp-card hp-card-hover">
                    <h3>Reputación comunitaria</h3>
                    <p class="hp-lead">Reconocimiento a quienes ayudan de forma constante.</p>
                </article>
            </div>
        </section>

        <section class="hp-section">
            <div class="hp-alert hp-alert-info">
                <h2 class="section-title">Cada reporte puede acercar una mascota a casa.</h2>
                <p class="section-lead">Tu publicación puede ser la diferencia entre perder una pista o reencontrar una familia.</p>
                <div class="hp-actions-row">
                    <a href="#publicaciones" class="hp-btn hp-btn-primary">Comenzar ahora</a>
                </div>
            </div>
        </section>
    </div>
@endsection
