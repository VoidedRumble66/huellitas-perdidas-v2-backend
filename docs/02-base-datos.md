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

---

## Bloque A: Comentarios, avistamientos, reportes y moderación

### Tabla: comments
**Propósito:** guardar comentarios y respuestas dentro de publicaciones.

**Campos principales:**
- `id`
- `post_id` (FK a `posts`)
- `user_id` (nullable, FK a `users`)
- `parent_id` (nullable, FK a `comments`)
- `body`
- `status` (default `visible`)
- `edited_at` (nullable)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `posts`.
- belongs-to con `users`.
- belongs-to con `comments` (parent).
- one-to-many con `comments` (replies).
- morph-many con `reports`.
- morph-many con `moderation_actions`.

**Notas importantes:**
- `post_id` usa `cascadeOnDelete`.
- `user_id` usa `nullOnDelete` para conservar historial.
- `parent_id` usa `nullOnDelete` para evitar borrar cadenas de respuestas completas.
- Índices: `post_id`, `user_id`, `parent_id`, `status`.
- Estados esperados: `visible`, `hidden`, `reported`, `deleted`.

### Tabla: post_sightings
**Propósito:** guardar avistamientos reportados por usuarios sobre publicaciones.

**Campos principales:**
- `id`
- `post_id` (FK a `posts`)
- `user_id` (nullable, FK a `users`)
- `location_id` (nullable, FK a `locations`)
- `description`
- `seen_at` (nullable)
- `confidence_level` (default `medium`)
- `status` (default `pending`)
- `reviewed_by` (nullable, FK a `users`)
- `reviewed_at` (nullable)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `posts`.
- belongs-to con `users` (autor y reviewer).
- belongs-to con `locations`.
- morph-many con `reports`.
- morph-many con `moderation_actions`.

**Notas importantes:**
- `post_id` usa `cascadeOnDelete`.
- `user_id`, `location_id` y `reviewed_by` usan `nullOnDelete`.
- Índices: `post_id`, `user_id`, `location_id`, `status`, `confidence_level`, `seen_at`.
- `confidence_level`: `low`, `medium`, `high`.
- `status`: `pending`, `confirmed`, `rejected`, `hidden`.

### Tabla: report_reasons
**Propósito:** catálogo de motivos para reportar contenido o comportamiento.

**Campos principales:**
- `id`
- `name` (único)
- `slug` (único)
- `description` (nullable)
- `applies_to` (json nullable)
- `active` (default `true`)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- one-to-many con `reports`.

**Notas importantes:**
- Seeder idempotente con motivos iniciales (spam, información falsa, duplicados, posible chantaje, etc.).
- `applies_to` permite definir entidades aplicables: posts, comments, sightings, users.

### Tabla: reports
**Propósito:** guardar reportes sobre publicaciones, comentarios, avistamientos o usuarios.

**Campos principales:**
- `id`
- `reporter_user_id` (nullable, FK a `users`)
- `reportable_type` + `reportable_id` (polimórfico)
- `report_reason_id` (FK a `report_reasons`)
- `description` (nullable)
- `status` (default `pending`)
- `priority` (default `normal`)
- `reviewed_by` (nullable, FK a `users`)
- `reviewed_at` (nullable)
- `resolution_notes` (nullable)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `users` (reporter y reviewer).
- belongs-to con `report_reasons`.
- morph-to `reportable`.
- morph-many con `moderation_actions` (target).

**Notas importantes:**
- `report_reason_id` usa `restrictOnDelete`.
- `reporter_user_id` y `reviewed_by` usan `nullOnDelete`.
- Índices: `reportable_type + reportable_id`, `status`, `priority`, `reporter_user_id`, `reviewed_by`, `created_at`.
- Estados: `pending`, `in_review`, `resolved`, `rejected`, `ignored`.
- Prioridad: `low`, `normal`, `high`, `critical`.

### Tabla: moderation_actions
**Propósito:** historial/auditoría de acciones administrativas sobre contenido o usuarios.

**Campos principales:**
- `id`
- `moderator_user_id` (nullable, FK a `users`)
- `target_type` + `target_id` (polimórfico)
- `action`
- `reason` (nullable)
- `previous_status` (nullable)
- `new_status` (nullable)
- `metadata` (json nullable)
- `created_at`
- `updated_at`

**Relaciones:**
- belongs-to con `users` como moderator.
- morph-to `target`.

**Notas importantes:**
- No usa soft deletes para conservar auditoría.
- Índices: `target_type + target_id`, `moderator_user_id`, `action`, `created_at`.
- Acciones esperadas: `approve`, `reject`, `hide`, `restore`, `delete`, `suspend_user`, `ban_user`, `mark_as_fake`, `mark_as_duplicate`, `mark_as_scam_attempt`, `resolve_report`, `ignore_report`.

---

## Bloque B: Adopciones y organizaciones

### Tabla: adoption_requests
**Propósito:** guardar solicitudes de usuarios interesados en adoptar mascotas publicadas.

**Campos principales:**
- `id`
- `post_id` (FK a `posts`)
- `applicant_user_id` (nullable, FK a `users`)
- `status` (default `pending`)
- `housing_type` (nullable)
- `has_other_pets` (nullable)
- `other_pets_description` (nullable)
- `experience_with_pets` (nullable)
- `reason_for_adoption` (nullable)
- `responsible_adult_name` (nullable)
- `contact_phone` (nullable)
- `contact_email` (nullable)
- `notes` (nullable)
- `selected_at`, `approved_at`, `rejected_at`, `cancelled_at`, `completed_at` (nullable)
- `reviewed_by` (nullable, FK a `users`)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `posts`.
- belongs-to con `users` como applicant.
- belongs-to con `users` como reviewer.
- one-to-many con `adoption_status_histories`.

**Notas importantes:**
- `post_id` usa `cascadeOnDelete`.
- `applicant_user_id` y `reviewed_by` usan `nullOnDelete`.
- Unique compuesto `post_id + applicant_user_id` para evitar duplicados por usuario/publicación.
- Estados: `pending`, `in_review`, `shortlisted`, `selected`, `approved`, `rejected`, `cancelled`, `completed`.
- `housing_type`: `house`, `apartment`, `ranch`, `other`, `unknown`.

### Tabla: adoption_status_histories
**Propósito:** registrar cada transición de estado de una solicitud de adopción.

**Campos principales:**
- `id`
- `adoption_request_id` (FK a `adoption_requests`)
- `changed_by` (nullable, FK a `users`)
- `old_status` (nullable)
- `new_status`
- `notes` (nullable)
- `metadata` (json nullable)
- `created_at`
- `updated_at`

**Relaciones:**
- belongs-to con `adoption_requests`.
- belongs-to con `users` como changedBy.

**Notas importantes:**
- `adoption_request_id` usa `cascadeOnDelete`.
- `changed_by` usa `nullOnDelete`.
- No usa soft deletes por ser historial.

### Tabla: organizations
**Propósito:** registrar refugios, veterinarias y otras organizaciones aliadas o futuras.

**Campos principales:**
- `id`
- `owner_user_id` (nullable, FK a `users`)
- `organization_type`
- `name`
- `slug` (único)
- `email`, `phone`, `whatsapp` (nullable)
- `description` (nullable)
- `logo_path` (nullable)
- `status` (default `pending_review`)
- `location_id` (nullable, FK a `locations`)
- `website_url`, `facebook_url`, `instagram_url` (nullable)
- `verified_at`, `approved_at`, `rejected_at` (nullable)
- `approved_by` (nullable, FK a `users`)
- `rejection_reason` (nullable)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `users` como owner.
- belongs-to con `users` como approver.
- belongs-to con `locations`.
- one-to-many con `organization_services`, `organization_schedules`, `organization_media`.

**Notas importantes:**
- `owner_user_id`, `approved_by` y `location_id` usan `nullOnDelete`.
- `organization_type`: `shelter`, `veterinary`, `association`, `store`, `rescuer_group`, `other`.
- `status`: `pending_review`, `approved`, `rejected`, `suspended`, `inactive`.

### Tabla: organization_services
**Propósito:** almacenar servicios ofrecidos por cada organización.

**Campos principales:**
- `id`
- `organization_id` (FK a `organizations`)
- `service_name`
- `description` (nullable)
- `estimated_cost` (nullable)
- `currency` (default `MXN`)
- `active` (default `true`)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `organizations`.

**Notas importantes:**
- `organization_id` usa `cascadeOnDelete`.
- Unique compuesto `organization_id + service_name`.
- Índice por `organization_id + active`.

### Tabla: organization_schedules
**Propósito:** guardar horarios de atención de organizaciones.

**Campos principales:**
- `id`
- `organization_id` (FK a `organizations`)
- `day_of_week` (1..7)
- `opens_at` (nullable)
- `closes_at` (nullable)
- `is_closed` (default `false`)
- `notes` (nullable)
- `timestamps`

**Relaciones:**
- belongs-to con `organizations`.

**Notas importantes:**
- `organization_id` usa `cascadeOnDelete`.
- Índice compuesto por `organization_id + day_of_week`.
- No usa soft deletes.

### Tabla: organization_media
**Propósito:** almacenar fotos, logos o documentos de organizaciones.

**Campos principales:**
- `id`
- `organization_id` (FK a `organizations`)
- `media_type` (default `photo`)
- `path`
- `original_filename` (nullable)
- `mime_type` (nullable)
- `size_kb` (nullable)
- `sort_order` (default `0`)
- `is_main` (default `false`)
- `metadata` (json nullable)
- `timestamps`
- `deleted_at` (SoftDeletes)

**Relaciones:**
- belongs-to con `organizations`.

**Notas importantes:**
- `organization_id` usa `cascadeOnDelete`.
- Índices: `organization_id + media_type`, `organization_id + is_main`, `organization_id + sort_order`.
- `media_type` esperado: `photo`, `logo`, `document`, `verification`, `other`.
