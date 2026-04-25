<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Huellitas Perdidas v2 - Plataforma comunitaria para mascotas perdidas, encontradas y en adopción.">
        <meta name="theme-color" content="#F27F3E">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Huellitas">
        <link rel="manifest" href="/manifest.webmanifest">
        <title>@yield('title', 'Huellitas Perdidas')</title>
        @yield('meta_tags')
        <link rel="stylesheet" href="{{ asset('css/huellitas.css') }}">
        @stack('styles')
        <script>
            (function () {
                const storageKey = 'huellitas-theme';
                const savedTheme = localStorage.getItem(storageKey);
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = savedTheme || (prefersDark ? 'dark' : 'light');
                document.documentElement.setAttribute('data-theme', theme);
            }());
        </script>
    </head>
    <body>
        <header class="hp-navbar">
            <div class="hp-container hp-navbar-row">
                <a class="hp-brand" href="{{ url('/') }}" aria-label="Inicio Huellitas Perdidas">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Logo de Huellitas Perdidas"
                        class="hp-logo"
                        onerror="this.classList.add('hp-hidden'); this.nextElementSibling.classList.remove('hp-hidden');"
                    >
                    <span class="hp-logo-fallback hp-hidden" aria-hidden="true">HP</span>
                    <span>Huellitas Perdidas</span>
                </a>

                <nav aria-label="Principal">
                    <ul class="hp-nav-links">
                        <li><a class="hp-nav-link hp-focus-ring" href="{{ url('/') }}">Inicio</a></li>
                        <li><a class="hp-nav-link hp-focus-ring" href="#publicaciones">Publicaciones</a></li>
                        <li><a class="hp-nav-link hp-focus-ring" href="#adopciones">Adopciones</a></li>
                        <li><a class="hp-nav-link hp-focus-ring" href="#refugios">Refugios y veterinarias</a></li>
                        <li><a class="hp-nav-link hp-focus-ring" href="#nosotros">Ayuda / Nosotros</a></li>
                    </ul>
                </nav>

                <div class="hp-actions">
                    <button class="hp-theme-toggle" id="theme-toggle" type="button" aria-label="Cambiar modo claro/oscuro" title="Cambiar tema">
                        <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1a.75.75 0 0 1 .75.75v.53a.75.75 0 0 1-1.5 0v-.53A.75.75 0 0 1 8 1zm0 10.72a3.72 3.72 0 1 1 0-7.44 3.72 3.72 0 0 1 0 7.44zm6.25-4.47a.75.75 0 0 1 0 1.5h-.53a.75.75 0 0 1 0-1.5h.53zM2.28 8a.75.75 0 0 1 0 1.5h-.53a.75.75 0 0 1 0-1.5h.53zm9.77 4.24a.75.75 0 0 1 1.06 0l.38.38a.75.75 0 1 1-1.06 1.06l-.38-.38a.75.75 0 0 1 0-1.06zM3.91 3.91a.75.75 0 0 1 1.06 0l.38.38a.75.75 0 0 1-1.06 1.06l-.38-.38a.75.75 0 0 1 0-1.06zm8.9-1.13a.75.75 0 0 1 1.06 1.06l-.38.38a.75.75 0 0 1-1.06-1.06l.38-.38zM4.97 12.24a.75.75 0 0 1 0 1.06l-.38.38a.75.75 0 1 1-1.06-1.06l.38-.38a.75.75 0 0 1 1.06 0z"/></svg>
                    </button>

                    <button class="hp-menu-toggle" id="mobile-toggle" type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Abrir menú principal">
                        <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M1.5 3.5A.75.75 0 0 1 2.25 2.75h11.5a.75.75 0 1 1 0 1.5H2.25a.75.75 0 0 1-.75-.75zm0 4.5a.75.75 0 0 1 .75-.75h11.5a.75.75 0 0 1 0 1.5H2.25A.75.75 0 0 1 1.5 8zm0 4.5a.75.75 0 0 1 .75-.75h11.5a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1-.75-.75z"/></svg>
                    </button>
                </div>
            </div>

            <div class="hp-container hp-mobile-menu" id="mobile-menu">
                <div class="hp-mobile-stack">
                    <a class="hp-nav-link hp-focus-ring" href="{{ url('/') }}">Inicio</a>
                    <a class="hp-nav-link hp-focus-ring" href="#publicaciones">Publicaciones</a>
                    <a class="hp-nav-link hp-focus-ring" href="#adopciones">Adopciones</a>
                    <a class="hp-nav-link hp-focus-ring" href="#refugios">Refugios y veterinarias</a>
                    <a class="hp-nav-link hp-focus-ring" href="#nosotros">Ayuda / Nosotros</a>
                </div>
            </div>

            <div class="hp-container hp-auth-row">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="#" class="hp-btn hp-btn-outline">Panel admin</a> {{-- TODO: reemplazar con route('admin.dashboard') cuando exista --}}
                    @endif
                    <a href="#" class="hp-btn hp-btn-outline">Mi perfil</a> {{-- TODO: reemplazar con route('profile.show') cuando exista --}}
                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="hp-btn hp-btn-outline" type="submit">Cerrar sesión</button>
                        </form>
                    @else
                        <a href="#" class="hp-btn hp-btn-outline">Cerrar sesión</a> {{-- TODO: reemplazar con logout real --}}
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="hp-btn hp-btn-outline">Iniciar sesión</a>
                    @else
                        <a href="#" class="hp-btn hp-btn-outline">Iniciar sesión</a> {{-- TODO: reemplazar con route('login') --}}
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hp-btn hp-btn-primary">Registrarse</a>
                    @else
                        <a href="#" class="hp-btn hp-btn-primary">Registrarse</a> {{-- TODO: reemplazar con route('register') --}}
                    @endif
                @endauth
            </div>
        </header>

        <main class="hp-main">
            @yield('content')
        </main>

        <footer class="hp-footer" id="nosotros">
            <div class="hp-container">
                <div class="hp-footer-grid">
                    <section>
                        <div class="hp-brand">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Logo de Huellitas Perdidas"
                                class="hp-logo"
                                onerror="this.classList.add('hp-hidden'); this.nextElementSibling.classList.remove('hp-hidden');"
                            >
                            <span class="hp-logo-fallback hp-hidden" aria-hidden="true">HP</span>
                            <span>Huellitas Perdidas</span>
                        </div>
                        <p>Huellitas Perdidas v2 - Plataforma comunitaria para mascotas perdidas, encontradas y en adopción.</p>
                    </section>

                    <section>
                        <h3>Enlaces rápidos</h3>
                        <ul class="hp-footer-links">
                            <li><a href="{{ url('/') }}">Inicio</a></li>
                            <li><a href="#publicaciones">Publicaciones</a></li>
                            <li><a href="#adopciones">Adopciones</a></li>
                            <li><a href="#refugios">Refugios y veterinarias</a></li>
                            <li><a href="#">Contacto</a></li> {{-- TODO: route/contacto cuando exista --}}
                        </ul>
                    </section>

                    <section>
                        <h3>Redes</h3>
                        <div class="hp-social" aria-label="Redes sociales">
                            <a class="hp-social-link" href="#" aria-label="Facebook">
                                <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M16 8.05C16 3.6 12.42 0 8 0S0 3.6 0 8.05c0 4 2.92 7.32 6.75 7.95v-5.63H4.72V8.05h2.03V6.3c0-2.02 1.2-3.14 3.04-3.14.88 0 1.8.16 1.8.16v1.98h-1.01c-.99 0-1.29.62-1.29 1.25v1.5h2.2l-.35 2.32H9.3V16C13.1 15.37 16 12.05 16 8.05z"/></svg>
                            </a>
                            <a class="hp-social-link" href="#" aria-label="WhatsApp">
                                <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M13.6 2.38A7.9 7.9 0 0 0 8.02.01c-4.36 0-7.9 3.53-7.9 7.9a7.86 7.86 0 0 0 1.06 3.96L0 16l4.23-1.1a7.86 7.86 0 0 0 3.77.97h.01c4.36 0 7.9-3.53 7.9-7.9a7.85 7.85 0 0 0-2.3-5.59zM8.01 14.5h-.01a6.5 6.5 0 0 1-3.31-.91l-.24-.14-2.51.65.67-2.44-.16-.25a6.52 6.52 0 0 1-1-3.45c0-3.6 2.93-6.53 6.54-6.53a6.46 6.46 0 0 1 4.63 1.92 6.48 6.48 0 0 1 1.9 4.62c0 3.6-2.93 6.53-6.52 6.53zm3.58-4.9c-.2-.1-1.18-.58-1.36-.65-.18-.07-.31-.1-.45.1-.13.2-.51.65-.63.78-.12.13-.24.15-.44.05-.2-.1-.87-.32-1.65-1.03-.61-.54-1.02-1.2-1.14-1.4-.12-.2-.01-.3.09-.4.09-.09.2-.24.3-.36.1-.12.13-.2.2-.34.07-.13.03-.25-.02-.35-.05-.1-.45-1.08-.62-1.48-.16-.38-.33-.33-.45-.34h-.38c-.13 0-.34.05-.52.25-.18.2-.68.66-.68 1.61s.7 1.87.79 2 .99 1.52 2.4 2.13c1.42.62 1.42.41 1.67.38.25-.04.82-.34.94-.67.12-.33.12-.62.08-.67-.03-.06-.16-.09-.35-.19z"/></svg>
                            </a>
                            <a class="hp-social-link" href="#" aria-label="Instagram">
                                <svg class="hp-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M8 3.9A4.1 4.1 0 1 0 8 12a4.1 4.1 0 0 0 0-8.1zm0 6.77A2.67 2.67 0 1 1 8 5.33a2.67 2.67 0 0 1 0 5.34zm4.2-6.95a.96.96 0 1 1-1.9 0 .96.96 0 0 1 1.9 0z"/><path d="M8 1.44c2.14 0 2.4.01 3.24.05.78.04 1.2.16 1.48.27.38.15.65.33.93.61.28.28.46.55.61.93.11.28.23.7.27 1.48.04.84.05 1.1.05 3.24s-.01 2.4-.05 3.24c-.04.78-.16 1.2-.27 1.48a2.5 2.5 0 0 1-.61.93c-.28.28-.55.46-.93.61-.28.11-.7.23-1.48.27-.84.04-1.1.05-3.24.05s-2.4-.01-3.24-.05c-.78-.04-1.2-.16-1.48-.27a2.5 2.5 0 0 1-.93-.61 2.5 2.5 0 0 1-.61-.93c-.11-.28-.23-.7-.27-1.48A54 54 0 0 1 1.44 8c0-2.14.01-2.4.05-3.24.04-.78.16-1.2.27-1.48.15-.38.33-.65.61-.93.28-.28.55-.46.93-.61.28-.11.7-.23 1.48-.27.84-.04 1.1-.05 3.24-.05zM8 0C5.82 0 5.55.01 4.69.05c-.86.04-1.45.18-1.96.38-.53.2-.98.48-1.43.93-.45.45-.73.9-.93 1.43-.2.51-.34 1.1-.38 1.96C0 5.55 0 5.82 0 8s.01 2.45.05 3.31c.04.86.18 1.45.38 1.96.2.53.48.98.93 1.43.45.45.9.73 1.43.93.51.2 1.1.34 1.96.38.86.04 1.13.05 3.31.05s2.45-.01 3.31-.05c.86-.04 1.45-.18 1.96-.38.53-.2.98-.48 1.43-.93.45-.45.73-.9.93-1.43.2-.51.34-1.1.38-1.96.04-.86.05-1.13.05-3.31s-.01-2.45-.05-3.31c-.04-.86-.18-1.45-.38-1.96a3.87 3.87 0 0 0-.93-1.43 3.87 3.87 0 0 0-1.43-.93c-.51-.2-1.1-.34-1.96-.38C10.45.01 10.18 0 8 0z"/></svg>
                            </a>
                        </div>
                    </section>
                </div>
                <div class="hp-footer-note">© {{ date('Y') }} Huellitas Perdidas · Web responsive + PWA · Comunidad primero.</div>
            </div>
        </footer>

        <script>
            (function () {
                const storageKey = 'huellitas-theme';
                const root = document.documentElement;
                const toggle = document.getElementById('theme-toggle');
                const mobileToggle = document.getElementById('mobile-toggle');
                const mobileMenu = document.getElementById('mobile-menu');

                function setTheme(theme) {
                    root.setAttribute('data-theme', theme);
                    localStorage.setItem(storageKey, theme);
                    const themeColorMeta = document.querySelector('meta[name="theme-color"]');
                    if (themeColorMeta) {
                        themeColorMeta.setAttribute('content', theme === 'dark' ? '#2C3E50' : '#F27F3E');
                    }
                }

                if (toggle) {
                    toggle.addEventListener('click', function () {
                        const current = root.getAttribute('data-theme') || 'light';
                        setTheme(current === 'dark' ? 'light' : 'dark');
                    });
                }

                if (mobileToggle && mobileMenu) {
                    mobileToggle.addEventListener('click', function () {
                        const isOpen = mobileMenu.classList.toggle('is-open');
                        mobileToggle.setAttribute('aria-expanded', String(isOpen));
                    });
                }

                if ('serviceWorker' in navigator) {
                    window.addEventListener('load', function () {
                        navigator.serviceWorker.register('/service-worker.js').catch(function () {
                            // Registro opcional, no bloquear carga de página.
                        });
                    });
                }
            }());
        </script>
        @stack('scripts')
    </body>
</html>
