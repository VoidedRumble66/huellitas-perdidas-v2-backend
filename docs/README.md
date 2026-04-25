# Huellitas Perdidas v2 - Documentación

Huellitas Perdidas v2 es la reestructuración completa del backend de la plataforma Huellitas Perdidas, enfocada en una base de datos limpia, flexible y escalable.

## Stack base
- **Laravel** como backend principal.
- **PostgreSQL** como base de datos principal.
- **Laravel Sanctum** para autenticación API con tokens.

## Alcance actual
- **Fase 1**: Usuarios (`users`), roles (`roles` + `role_user`) y perfiles (`user_profiles`).
- **Fase 2**: Catálogos y ubicación (`species`, `breeds`, `colors`, `states`, `municipalities`, `neighborhoods`, `locations`).
- **Fase 3**: Mascotas y publicaciones (`pets`, `posts`, `post_lost_details`, `post_found_details`, `post_adoption_details`, `post_photos`).
- **Bloque A**: Comentarios, avistamientos, reportes y moderación (`comments`, `post_sightings`, `report_reasons`, `reports`, `moderation_actions`).
- **Bloque B**: Adopciones y organizaciones (`adoption_requests`, `adoption_status_histories`, `organizations`, `organization_services`, `organization_schedules`, `organization_media`).

## Objetivo de consumo
El backend queda preparado para:
- Soportar la plataforma web responsive + PWA actual.
- Exponer API futura para app móvil nativa o híbrida.
- Mantener evolución en Blade y evaluar Livewire en etapas posteriores.

## Entorno local
El desarrollo local está pensado para **Laravel Herd**.
