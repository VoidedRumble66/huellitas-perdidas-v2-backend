# 02 - Base de datos

## Fase 1: Usuarios, roles y perfiles

### Tabla: users
**Propósito:** almacenar cuentas de usuario autenticables.

**Campos principales:**
- `id`
- `name`
- `email` (único)
- `phone` (nullable)
- `password` (nullable)
- `avatar_path` (nullable)
- `email_verified_at` (nullable)
- `phone_verified_at` (nullable)
- `google_id` (nullable, único)
- `facebook_id` (nullable, único)
- `status` (por defecto `pending`)
- `last_login_at` (nullable)
- `remember_token`
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- many-to-many con `roles` vía `role_user`.
- one-to-one con `user_profiles`.

**Notas importantes:**
- `password` nullable permite cuentas sociales futuras (Google/Facebook).
- `status` esperado: `active`, `pending`, `suspended`, `banned`, `deleted`.

### Tabla: roles
**Propósito:** catálogo simple de roles del sistema.

**Campos principales:**
- `id`
- `name` (único)
- `display_name`
- `description` (nullable)
- `timestamps`

**Relaciones:**
- many-to-many con `users` vía `role_user`.

**Notas importantes:**
- Seeder idempotente con roles base: admin, moderator, pet_owner, rescuer, adopter, shelter, veterinary.

### Tabla: role_user
**Propósito:** pivote para asignar múltiples roles a usuarios.

**Campos principales:**
- `id`
- `user_id` (FK)
- `role_id` (FK)
- `timestamps`
- unique compuesto `user_id` + `role_id`

**Relaciones:**
- pertenece a `users` y `roles`.

**Notas importantes:**
- FKs con `cascadeOnDelete`.

### Tabla: user_profiles
**Propósito:** separar información extendida de perfil para mantener `users` más limpia.

**Campos principales:**
- `id`
- `user_id` (único, FK)
- `first_name` (nullable)
- `last_name` (nullable)
- `bio` (nullable)
- `address_reference` (nullable)
- `privacy_contact_level` (default `hidden`)
- `timestamps`

**Relaciones:**
- belongs-to con `users`.

**Notas importantes:**
- `privacy_contact_level` esperado: `hidden`, `only_verified_users`, `public`.

---

## Fase 2: Catálogos y ubicación

### Tabla: species
**Propósito:** catálogo de especies de mascotas domésticas.

**Campos principales:**
- `id`
- `name` (único)
- `slug` (único)
- `description` (nullable)
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- one-to-many con `breeds`.

**Notas importantes:**
- Se inicializa con especies base (Perro, Gato, Conejo, Ave, etc.).

### Tabla: breeds
**Propósito:** catálogo de razas asociadas a una especie.

**Campos principales:**
- `id`
- `species_id` (FK)
- `name`
- `slug`
- `description` (nullable)
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `species`.

**Notas importantes:**
- unique compuesto `species_id + name`.
- unique compuesto `species_id + slug`.
- `species_id` usa `restrictOnDelete` para proteger catálogo.

### Tabla: colors
**Propósito:** catálogo de colores predominantes de mascotas.

**Campos principales:**
- `id`
- `name` (único)
- `slug` (único)
- `hex` (nullable)
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- Sin relaciones en esta fase; queda preparada para relación futura con mascotas.

**Notas importantes:**
- Incluye colores y patrones (por ejemplo: Manchado, Atigrado, Mixto).

### Tabla: states
**Propósito:** catálogo de estados para cobertura nacional escalable.

**Campos principales:**
- `id`
- `name` (único)
- `slug` (único)
- `code` (nullable)
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- one-to-many con `municipalities`.
- one-to-many con `locations`.

**Notas importantes:**
- Seeder inicia con Chiapas, pero el diseño permite crecimiento a otros estados.

### Tabla: municipalities
**Propósito:** catálogo de municipios dependientes de un estado.

**Campos principales:**
- `id`
- `state_id` (FK)
- `name`
- `slug`
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `states`.
- one-to-many con `neighborhoods`.
- one-to-many con `locations`.

**Notas importantes:**
- unique compuesto `state_id + name`.
- unique compuesto `state_id + slug`.
- `state_id` usa `restrictOnDelete`.

### Tabla: neighborhoods
**Propósito:** catálogo de colonias/barrios por municipio.

**Campos principales:**
- `id`
- `municipality_id` (FK)
- `name`
- `slug`
- `postal_code` (nullable)
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `municipalities`.
- one-to-many con `locations`.

**Notas importantes:**
- unique compuesto `municipality_id + name`.
- unique compuesto `municipality_id + slug`.
- `municipality_id` usa `restrictOnDelete`.

### Tabla: locations
**Propósito:** tabla reusable para geolocalización de módulos futuros (publicaciones, mascotas, refugios, etc.).

**Campos principales:**
- `id`
- `label` (nullable)
- `address` (nullable)
- `reference` (nullable)
- `latitude` decimal(10,7) (nullable)
- `longitude` decimal(10,7) (nullable)
- `state_id` (nullable, FK)
- `municipality_id` (nullable, FK)
- `neighborhood_id` (nullable, FK)
- `accuracy_meters` (nullable)
- `metadata` jsonb (nullable)
- `timestamps`

**Relaciones:**
- belongs-to con `states`.
- belongs-to con `municipalities`.
- belongs-to con `neighborhoods`.

**Notas importantes:**
- No usa soft deletes en esta fase para mantener historial de ubicaciones.
- FKs con `nullOnDelete` para preservar registros históricos aun si cambia catálogo.
- `metadata` permite flexibilidad para datos de GPS/mapa/fuente.
