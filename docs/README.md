# Huellitas Perdidas v2 - Documentación

Huellitas Perdidas v2 es la reestructuración completa del backend de la plataforma Huellitas Perdidas, enfocada en una base de datos limpia, flexible y escalable.

## Stack base
- **Laravel** como backend principal.
- **PostgreSQL** como base de datos principal.
- **Laravel Sanctum** para autenticación API con tokens.

## Alcance de la fase 1
Esta primera fase incluye únicamente:
- Usuarios (`users`)
- Roles (`roles` + pivote `role_user`)
- Perfiles de usuario (`user_profiles`)

## Objetivo de consumo
El backend queda preparado para:
- Exponer API para app móvil en Flutter.
- Soportar una web administrativa futura (Blade; con posibilidad de Livewire más adelante).

## Entorno local
El desarrollo local está pensado para **Laravel Herd**.
