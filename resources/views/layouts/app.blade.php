<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#F27F3E">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Huellitas">
        <link rel="manifest" href="/manifest.webmanifest">
        <title>@yield('title', 'Huellitas Perdidas')</title>
        <link rel="stylesheet" href="/css/huellitas.css">
        @stack('head')
        <script>
            (function () {
                const savedTheme = localStorage.getItem('hp-theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = savedTheme || (systemDark ? 'dark' : 'light');
                document.documentElement.setAttribute('data-theme', theme);
            }());
        </script>
    </head>
    <body>
        <header class="site-header">
            <div class="container navbar">
                <a class="brand" href="{{ url('/') }}" aria-label="Inicio Huellitas Perdidas">
                    <span class="brand-mark" aria-hidden="true">
                        <svg class="icon" viewBox="0 0 16 16" fill="currentColor"><path d="M8 9.5c1.5 0 2.5 1 2.5 2.2 0 1.1-1 1.8-2.5 1.8S5.5 12.8 5.5 11.7C5.5 10.5 6.5 9.5 8 9.5zm-4-1.9c0 1-.7 1.8-1.6 1.8S.8 8.7.8 7.6 1.5 5.8 2.4 5.8 4 6.5 4 7.6zm11.2 0c0 1-.7 1.8-1.6 1.8S12 8.7 12 7.6s.7-1.8 1.6-1.8 1.6.8 1.6 1.8zM5.5 4.1c0 1-.7 1.8-1.6 1.8S2.3 5.1 2.3 4.1s.7-1.8 1.6-1.8 1.6.8 1.6 1.8zm8.2 0c0 1-.7 1.8-1.6 1.8s-1.6-.8-1.6-1.8.7-1.8 1.6-1.8 1.6.8 1.6 1.8z"/></svg>
                    </span>
                    <span>Huellitas Perdidas</span>
                </a>

                <nav aria-label="Principal">
                    <ul class="nav-links">
                        <li><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
                        <li><a class="nav-link" href="#publicaciones">Publicaciones</a></li>
                        <li><a class="nav-link" href="#adopciones">Adopciones</a></li>
                        <li><a class="nav-link" href="#refugios">Refugios / Veterinarias</a></li>
                        <li><a class="nav-link" href="#ayuda">Ayuda</a></li>
                    </ul>
                </nav>

                <div class="header-actions">
                    <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Cambiar tema" title="Cambiar tema">
                        <svg class="icon" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1a.75.75 0 0 1 .75.75v.53a.75.75 0 0 1-1.5 0v-.53A.75.75 0 0 1 8 1zm0 10.72a3.72 3.72 0 1 1 0-7.44 3.72 3.72 0 0 1 0 7.44zm6.25-4.47a.75.75 0 0 1 0 1.5h-.53a.75.75 0 0 1 0-1.5h.53zM2.28 8a.75.75 0 0 1 0 1.5h-.53a.75.75 0 0 1 0-1.5h.53zm9.77 4.24a.75.75 0 0 1 1.06 0l.38.38a.75.75 0 1 1-1.06 1.06l-.38-.38a.75.75 0 0 1 0-1.06zM3.91 3.91a.75.75 0 0 1 1.06 0l.38.38a.75.75 0 0 1-1.06 1.06l-.38-.38a.75.75 0 0 1 0-1.06zm8.9-1.13a.75.75 0 0 1 1.06 1.06l-.38.38a.75.75 0 0 1-1.06-1.06l.38-.38zM4.97 12.24a.75.75 0 0 1 0 1.06l-.38.38a.75.75 0 1 1-1.06-1.06l.38-.38a.75.75 0 0 1 1.06 0z"/></svg>
                    </button>

                    <button class="mobile-toggle" id="mobile-toggle" type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Abrir menú">
                        <svg class="icon" viewBox="0 0 16 16" fill="currentColor"><path d="M1.5 3.5A.75.75 0 0 1 2.25 2.75h11.5a.75.75 0 1 1 0 1.5H2.25a.75.75 0 0 1-.75-.75zm0 4.5a.75.75 0 0 1 .75-.75h11.5a.75.75 0 0 1 0 1.5H2.25A.75.75 0 0 1 1.5 8zm0 4.5a.75.75 0 0 1 .75-.75h11.5a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1-.75-.75z"/></svg>
                    </button>
                </div>
            </div>

            <div class="container mobile-menu" id="mobile-menu">
                <div class="stack">
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    <a class="nav-link" href="#publicaciones">Publicaciones</a>
                    <a class="nav-link" href="#adopciones">Adopciones</a>
                    <a class="nav-link" href="#refugios">Refugios / Veterinarias</a>
                    <a class="nav-link" href="#ayuda">Ayuda</a>
                </div>
            </div>

            <div class="container" style="padding: .35rem 0 .75rem; display: flex; flex-wrap: wrap; gap: .5rem; align-items: center;">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="#" class="btn btn-outline">Panel admin</a>
                    @endif
                    <a href="#" class="btn btn-outline">Mi perfil</a>
                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline" type="submit">Cerrar sesión</button>
                        </form>
                    @else
                        <a href="#" class="btn btn-outline">Cerrar sesión</a>
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline">Iniciar sesión</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                    @endif
                @endauth
            </div>
        </header>

        <main class="site-main">
            @yield('content')
        </main>

        <footer class="site-footer" id="ayuda">
            <div class="container">
                <div class="footer-grid">
                    <section>
                        <h3 class="footer-title">Huellitas Perdidas</h3>
                        <p>Comunidad digital para reportar, encontrar y apoyar casos de mascotas perdidas, encontradas y en adopción.</p>
                    </section>
                    <section>
                        <h3 class="footer-title">Enlaces rápidos</h3>
                        <ul class="footer-list">
                            <li><a href="#publicaciones">Publicaciones</a></li>
                            <li><a href="#adopciones">Adopciones</a></li>
                            <li><a href="#refugios">Refugios / Veterinarias</a></li>
                            <li><a href="#">Política de privacidad</a></li>
                        </ul>
                    </section>
                    <section>
                        <h3 class="footer-title">Contacto</h3>
                        <p>Soporte comunitario y alianzas locales.</p>
                        <div class="social-list" aria-label="Redes sociales">
                            <a class="social-link" href="#" aria-label="Facebook">
                                <svg class="icon" viewBox="0 0 16 16" fill="currentColor"><path d="M16 8.05C16 3.6 12.42 0 8 0S0 3.6 0 8.05c0 4 2.92 7.32 6.75 7.95v-5.63H4.72V8.05h2.03V6.3c0-2.02 1.2-3.14 3.04-3.14.88 0 1.8.16 1.8.16v1.98h-1.01c-.99 0-1.29.62-1.29 1.25v1.5h2.2l-.35 2.32H9.3V16C13.1 15.37 16 12.05 16 8.05z"/></svg>
                            </a>
                            <a class="social-link" href="#" aria-label="WhatsApp">
                                <svg class="icon" viewBox="0 0 16 16" fill="currentColor"><path d="M13.6 2.38A7.9 7.9 0 0 0 8.02.01c-4.36 0-7.9 3.53-7.9 7.9a7.86 7.86 0 0 0 1.06 3.96L0 16l4.23-1.1a7.86 7.86 0 0 0 3.77.97h.01c4.36 0 7.9-3.53 7.9-7.9a7.85 7.85 0 0 0-2.3-5.59zM8.01 14.5h-.01a6.5 6.5 0 0 1-3.31-.91l-.24-.14-2.51.65.67-2.44-.16-.25a6.52 6.52 0 0 1-1-3.45c0-3.6 2.93-6.53 6.54-6.53a6.46 6.46 0 0 1 4.63 1.92 6.48 6.48 0 0 1 1.9 4.62c0 3.6-2.93 6.53-6.52 6.53zm3.58-4.9c-.2-.1-1.18-.58-1.36-.65-.18-.07-.31-.1-.45.1-.13.2-.51.65-.63.78-.12.13-.24.15-.44.05-.2-.1-.87-.32-1.65-1.03-.61-.54-1.02-1.2-1.14-1.4-.12-.2-.01-.3.09-.4.09-.09.2-.24.3-.36.1-.12.13-.2.2-.34.07-.13.03-.25-.02-.35-.05-.1-.45-1.08-.62-1.48-.16-.38-.33-.33-.45-.34h-.38c-.13 0-.34.05-.52.25-.18.2-.68.66-.68 1.61s.7 1.87.79 2 .99 1.52 2.4 2.13c1.42.62 1.42.41 1.67.38.25-.04.82-.34.94-.67.12-.33.12-.62.08-.67-.03-.06-.16-.09-.35-.19z"/></svg>
                            </a>
                            <a class="social-link" href="#" aria-label="Instagram">
                                <svg class="icon" viewBox="0 0 16 16" fill="currentColor"><path d="M8 3.9A4.1 4.1 0 1 0 8 12a4.1 4.1 0 0 0 0-8.1zm0 6.77A2.67 2.67 0 1 1 8 5.33a2.67 2.67 0 0 1 0 5.34zm4.2-6.95a.96.96 0 1 1-1.9 0 .96.96 0 0 1 1.9 0z"/><path d="M8 1.44c2.14 0 2.4.01 3.24.05.78.04 1.2.16 1.48.27.38.15.65.33.93.61.28.28.46.55.61.93.11.28.23.7.27 1.48.04.84.05 1.1.05 3.24s-.01 2.4-.05 3.24c-.04.78-.16 1.2-.27 1.48a2.5 2.5 0 0 1-.61.93c-.28.28-.55.46-.93.61-.28.11-.7.23-1.48.27-.84.04-1.1.05-3.24.05s-2.4-.01-3.24-.05c-.78-.04-1.2-.16-1.48-.27a2.5 2.5 0 0 1-.93-.61 2.5 2.5 0 0 1-.61-.93c-.11-.28-.23-.7-.27-1.48A54 54 0 0 1 1.44 8c0-2.14.01-2.4.05-3.24.04-.78.16-1.2.27-1.48.15-.38.33-.65.61-.93.28-.28.55-.46.93-.61.28-.11.7-.23 1.48-.27.84-.04 1.1-.05 3.24-.05zM8 0C5.82 0 5.55.01 4.69.05c-.86.04-1.45.18-1.96.38-.53.2-.98.48-1.43.93-.45.45-.73.9-.93 1.43-.2.51-.34 1.1-.38 1.96C0 5.55 0 5.82 0 8s.01 2.45.05 3.31c.04.86.18 1.45.38 1.96.2.53.48.98.93 1.43.45.45.9.73 1.43.93.51.2 1.1.34 1.96.38.86.04 1.13.05 3.31.05s2.45-.01 3.31-.05c.86-.04 1.45-.18 1.96-.38.53-.2.98-.48 1.43-.93.45-.45.73-.9.93-1.43.2-.51.34-1.1.38-1.96.04-.86.05-1.13.05-3.31s-.01-2.45-.05-3.31c-.04-.86-.18-1.45-.38-1.96a3.87 3.87 0 0 0-.93-1.43 3.87 3.87 0 0 0-1.43-.93c-.51-.2-1.1-.34-1.96-.38C10.45.01 10.18 0 8 0z"/></svg>
                            </a>
                        </div>
                    </section>
                </div>
                <div class="small-note">© {{ date('Y') }} Huellitas Perdidas v2 · Web responsive + PWA · Comunidad primero.</div>
            </div>
        </footer>

        <script>
            (function () {
                const root = document.documentElement;
                const toggle = document.getElementById('theme-toggle');
                const mobileToggle = document.getElementById('mobile-toggle');
                const mobileMenu = document.getElementById('mobile-menu');

                function applyTheme(theme) {
                    root.setAttribute('data-theme', theme);
                    localStorage.setItem('hp-theme', theme);
                    const themeColorMeta = document.querySelector('meta[name="theme-color"]');
                    if (themeColorMeta) {
                        themeColorMeta.setAttribute('content', theme === 'dark' ? '#2C3E50' : '#F27F3E');
                    }
                }

                if (toggle) {
                    toggle.addEventListener('click', function () {
                        const isDark = root.getAttribute('data-theme') === 'dark';
                        applyTheme(isDark ? 'light' : 'dark');
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
                            // Registro opcional: no interrumpir UX si falla.
                        });
                    });
                }
            }());
        </script>
        @stack('scripts')
    </body>
</html>
