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

---

## Fase 3: Mascotas y publicaciones

### Tabla: pets
**Propósito:** almacenar la información base de la mascota independientemente del tipo de publicación.

**Campos principales:**
- `id`
- `owner_user_id` (nullable, FK a `users`)
- `name` (nullable)
- `species_id` (FK a `species`)
- `breed_id` (nullable, FK a `breeds`)
- `sex` (default `unknown`)
- `size` (default `unknown`)
- `main_color_id` (nullable, FK a `colors`)
- `secondary_color_id` (nullable, FK a `colors`)
- `birth_date` (nullable)
- `approximate_age` (nullable)
- `distinctive_signs` (nullable)
- `sterilized` (nullable)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `users` como owner.
- belongs-to con `species`.
- belongs-to con `breeds`.
- belongs-to con `colors` (main y secondary).
- one-to-many con `posts`.

**Notas importantes:**
- `owner_user_id`, `breed_id`, `main_color_id` y `secondary_color_id` usan `nullOnDelete`.
- `species_id` usa `restrictOnDelete`.
- Valores esperados:
  - `sex`: `male`, `female`, `unknown`.
  - `size`: `small`, `medium`, `large`, `extra_large`, `unknown`.

### Tabla: posts
**Propósito:** tabla central para cualquier tipo de publicación del sistema.

**Campos principales:**
- `id`
- `author_user_id` (FK a `users`)
- `pet_id` (nullable, FK a `pets`)
- `post_type`
- `status` (default `draft`)
- `visibility` (default `public`)
- `title`
- `description` (nullable)
- `location_id` (nullable, FK a `locations`)
- `contact_method` (default `platform`)
- `contact_phone` (nullable)
- `contact_whatsapp` (nullable)
- `expires_at` (nullable)
- `published_at` (nullable)
- `resolved_at` (nullable)
- `rejection_reason` (nullable)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `users` como author.
- belongs-to con `pets`.
- belongs-to con `locations`.
- one-to-one con `post_lost_details`, `post_found_details`, `post_adoption_details`.
- one-to-many con `post_photos`.

**Notas importantes:**
- `author_user_id` usa `restrictOnDelete`.
- `pet_id` y `location_id` usan `nullOnDelete`.
- Índices por `post_type`, `status`, `visibility`, `published_at`, `created_at`.
- Índice compuesto: `post_type + status + visibility`.
- Valores esperados:
  - `post_type`: `lost`, `found`, `adoption`, `care_tip`, `alert`.
  - `status`: `draft`, `pending_review`, `published`, `rejected`, `paused`, `resolved`, `archived`, `deleted`.
  - `visibility`: `public`, `private`, `hidden`.
  - `contact_method`: `platform`, `whatsapp`, `phone`, `hidden`.

### Tabla: post_lost_details
**Propósito:** información específica para publicaciones de mascota perdida.

**Campos principales:**
- `id`
- `post_id` (único, FK a `posts`)
- `lost_at` (nullable)
- `last_seen_description` (nullable)
- `reward_offered` (default `false`)
- `reward_amount` (nullable)
- `safe_contact_instructions` (nullable)
- `timestamps`

**Relaciones:**
- belongs-to con `posts`.

**Notas importantes:**
- `post_id` único garantiza máximo un detalle por post.
- FK con `cascadeOnDelete`.

### Tabla: post_found_details
**Propósito:** información específica para publicaciones de mascota encontrada.

**Campos principales:**
- `id`
- `post_id` (único, FK a `posts`)
- `found_at` (nullable)
- `current_pet_condition` (nullable)
- `is_pet_sheltered` (default `false`)
- `temporary_shelter_description` (nullable)
- `handover_instructions` (nullable)
- `timestamps`

**Relaciones:**
- belongs-to con `posts`.

**Notas importantes:**
- `post_id` único garantiza máximo un detalle por post.
- FK con `cascadeOnDelete`.

### Tabla: post_adoption_details
**Propósito:** información específica para publicaciones de adopción.

**Campos principales:**
- `id`
- `post_id` (único, FK a `posts`)
- `vaccinated` (nullable)
- `vaccines_description` (nullable)
- `health_status` (nullable)
- `sterilized` (nullable)
- `adoption_requirements` (nullable)
- `adoption_fee` (nullable)
- `adoption_process_notes` (nullable)
- `good_with_children` (nullable)
- `good_with_dogs` (nullable)
- `good_with_cats` (nullable)
- `energy_level` (nullable)
- `requires_yard` (nullable)
- `timestamps`

**Relaciones:**
- belongs-to con `posts`.

**Notas importantes:**
- `post_id` único garantiza máximo un detalle por post.
- FK con `cascadeOnDelete`.
- `energy_level` esperado: `low`, `medium`, `high`, `unknown`.

### Tabla: post_photos
**Propósito:** almacenar fotos relacionadas a publicaciones.

**Campos principales:**
- `id`
- `post_id` (FK a `posts`)
- `path`
- `thumbnail_path` (nullable)
- `original_filename` (nullable)
- `mime_type` (nullable)
- `size_kb` (nullable)
- `width` (nullable)
- `height` (nullable)
- `sort_order` (default `0`)
- `is_main` (default `false`)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `posts`.

**Notas importantes:**
- FK con `cascadeOnDelete`.
- Índices compuestos por `post_id + is_main` y `post_id + sort_order`.
- Solo se define estructura de BD; no almacenamiento físico de archivos en esta fase.
