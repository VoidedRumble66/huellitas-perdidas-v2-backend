# Huellitas Perdidas v2 - Documentación

Huellitas Perdidas v2 es la reestructuración completa del backend de la plataforma Huellitas Perdidas, enfocada en una base de datos limpia, flexible y escalable.

## Stack base
- **Laravel** como backend principal.
- **PostgreSQL** como base de datos principal.
- **Laravel Sanctum** para autenticación API con tokens.

## Alcance actual
- **Fase 1**: Usuarios (`users`), roles (`roles` + `role_user`) y perfiles (`user_profiles`).
- **Fase 2**: Catálogos y ubicación (`species`, `breeds`, `colors`, `states`, `municipalities`, `neighborhoods`, `locations`).

## Objetivo de consumo
El backend queda preparado para:
- Exponer API para app móvil en Flutter.
- Soportar una web administrativa futura (Blade; con posibilidad de Livewire más adelante).

## Entorno local
El desarrollo local está pensado para **Laravel Herd**.
