# 13 - Home pública dinámica inicial

## Objetivo
La home pública evoluciona de una versión estática a una versión dinámica que consulta publicaciones reales, sin requerir autenticación.

## Ruta y controlador
- Ruta: `GET /`
- Controlador: `HomeController@index`
- Vista: `resources/views/welcome.blade.php`

## Datos mostrados en home
La home muestra dos bloques de publicaciones recientes:

1. **Mascotas perdidas recientemente**
   - Fuente: `posts` con filtros:
     - `post_type = lost`
     - `status = published`
     - `visibility = public`
   - Orden: `published_at DESC`, fallback `created_at DESC`.
   - Límite: 4.

2. **Mascotas en adopción recientemente**
   - Fuente: `posts` con filtros:
     - `post_type = adoption`
     - `status = published`
     - `visibility = public`
   - Orden: `published_at DESC`, fallback `created_at DESC`.
   - Límite: 4.

## ¿Por qué 4 + 4?
- Permite escaneo rápido en móvil y desktop.
- Mantiene la home liviana y enfocada.
- Evita saturar la pantalla inicial mientras se construyen listados completos.

## Comportamiento sin datos (empty states)
- Si no hay reportes perdidos, se muestra tarjeta informativa con mensaje orientativo.
- Si no hay adopciones, se muestra tarjeta equivalente.
- No se generan errores de render por colecciones vacías.

## Imagen principal de publicación
- Se intenta usar `mainPhoto.thumbnail_path` y luego `mainPhoto.path`.
- Si no existe imagen, se usa placeholder visual “Sin imagen”.
- Esto evita depender de recursos externos y evita fallos por datos incompletos.

## Rutas futuras y compatibilidad
Para enlaces de detalle/listado se usan rutas seguras:
- Si existe ruta nominal, se usa.
- Si no existe aún, se usa `#` como fallback.

Esto permite avanzar UI pública sin bloquearse por módulos todavía no implementados.

## Acceso público
- La home es accesible sin iniciar sesión.
- Está diseñada como punto de entrada comunitario para consulta y difusión de casos.
