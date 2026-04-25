const CACHE_NAME = 'huellitas-pwa-v1';
const MINIMAL_ASSETS = ['/', '/manifest.webmanifest'];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches
            .open(CACHE_NAME)
            .then((cache) => cache.addAll(MINIMAL_ASSETS))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches
            .keys()
            .then((keys) =>
                Promise.all(
                    keys
                        .filter((key) => key !== CACHE_NAME)
                        .map((key) => caches.delete(key))
                )
            )
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    const { request } = event;

    // En esta etapa solo aplicamos fallback básico para navegación.
    // No cacheamos respuestas con datos sensibles ni rutas administrativas.
    if (request.mode !== 'navigate') {
        return;
    }

    event.respondWith(
        fetch(request).catch(() => caches.match('/'))
    );
});

// TODO: Implementar estrategia offline más completa en fases futuras,
// cuidando explícitamente sesiones, tokens y rutas privadas.
