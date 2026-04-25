# 06 - Mascotas y publicaciones

## ¿Por qué usar una tabla central `posts`?
La tabla `posts` permite unificar comportamiento común de cualquier publicación:
- autor,
- estado,
- visibilidad,
- ubicación,
- fechas de publicación/resolución,
- metadatos.

Esto evita duplicar lógica entre publicaciones de pérdida, hallazgo y adopción.

## ¿Por qué no separar en tablas de publicaciones por tipo?
Si se separaran completamente (`lost_posts`, `found_posts`, `adoption_posts`), se duplicarían columnas comunes y la lógica de consulta/filtros sería más compleja.

Con un diseño central + detalles por tipo:
- se mantiene consistencia,
- se simplifica búsqueda global,
- se facilita agregar nuevos tipos (`care_tip`, `alert`, etc.).

## Tablas de detalle por tipo
- `post_lost_details`
- `post_found_details`
- `post_adoption_details`

Cada una tiene relación 1:1 con `posts` (`post_id` único), de modo que solo guarda información especializada de su tipo sin contaminar el esquema base.

## Relación entre `pets`, `posts`, `locations` y `post_photos`
- `pets` guarda la identidad de la mascota de forma independiente.
- `posts` referencia opcionalmente a `pets` y `locations`.
- `locations` centraliza ubicación para filtros y mapas.
- `post_photos` permite múltiples fotos por publicación y definir foto principal.

Este diseño desacopla entidades y habilita reutilización en módulos futuros.

## Estados de publicación
Los estados contemplados son:
- `draft`
- `pending_review`
- `published`
- `rejected`
- `paused`
- `resolved`
- `archived`
- `deleted`

Esto permite controlar moderación, visibilidad y ciclo de vida completo de cada publicación.

## Escalabilidad futura
La estructura soporta crecimiento sin romper diseño actual:
- nuevos tipos de publicación en `post_type`,
- nuevos detalles especializados en tablas 1:1,
- más reglas de negocio sin rediseñar por completo las tablas centrales.
