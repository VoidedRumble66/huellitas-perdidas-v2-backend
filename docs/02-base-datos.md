# 02 - Base de datos (fase 1)

## Tabla: users
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

## Tabla: roles
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

## Tabla: role_user
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

## Tabla: user_profiles
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
