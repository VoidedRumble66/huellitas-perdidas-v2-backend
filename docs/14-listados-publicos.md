# 14 - Listados públicos y detalle básico

## Rutas públicas
- `GET /publicaciones` → `posts.index`
- `GET /adopciones` → `adoptions.index`
- `GET /publicaciones/{post}` → `posts.show`
- `GET /adopciones/{post}` → `adoptions.show`

## ¿Qué muestra `/publicaciones`?
- Solo publicaciones públicas y publicadas de tipo `lost`.
- Paginación de 12 elementos por página.
- Búsqueda básica por texto (`q`) en título, descripción y nombre de mascota.
- Cards con foto principal (o placeholder), especie, raza, ubicación, fecha y resumen.

## ¿Qué muestra `/adopciones`?
- Solo publicaciones públicas y publicadas de tipo `adoption`.
- Paginación de 12 elementos por página.
- Búsqueda básica por texto (`q`) en título, descripción y nombre de mascota.
- Cards con foto principal (o placeholder), especie, raza, sexo/edad si existe, ubicación y resumen.

## ¿Qué muestra el detalle?
- Foto principal grande.
- Mini galería (hasta 4 fotos) cuando existen más fotos.
- Datos clave: tipo, estado, especie, raza, color principal, sexo, edad aproximada, ubicación, fecha y descripción.
- Bloque de acciones públicas visuales (placeholders seguros): compartir, reportar avistamiento / interés de adopción, contactar.

## Filtros básicos
- Query string `q` para búsqueda simple.

## Comportamiento sin datos
- Listados con empty state visual reutilizable.
- Mensajes de orientación para usuario sin romper layout ni navegación.

## Conexión con la home
- Botón principal “Ver publicaciones” enlaza a `posts.index`.
- Botón secundario del hero enlaza a `adoptions.index`.
- En secciones recientes, “Ver todas” enlaza a listados públicos.
- Las tarjetas recientes usan enlaces reales a detalle cuando la ruta existe.
