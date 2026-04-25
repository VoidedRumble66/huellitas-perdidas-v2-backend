# 08 - Adopciones y organizaciones

## Flujo de solicitud de adopción
El flujo parte de una publicación (`posts`) y permite que un usuario cree una solicitud en `adoption_requests`.

Estados clave del ciclo:
- `pending`
- `in_review`
- `selected`
- `approved`
- `rejected`
- `cancelled`
- `completed`

## ¿Por qué usar `adoption_status_histories`?
El historial guarda trazabilidad de cada transición de estado:
- quién cambió el estado,
- de qué estado venía,
- a qué estado pasó,
- notas y metadata adicional.

Esto facilita auditoría, soporte y análisis posterior.

## Refugios y veterinarias como `organizations`
Se unifica el concepto de actor institucional en una sola tabla `organizations`.
Así se evita duplicar estructuras para refugios y veterinarias.

## Escalabilidad con `organization_type`
`organization_type` permite ampliar sin rediseñar:
- `shelter`
- `veterinary`
- `association`
- `store`
- `rescuer_group`
- `other`

Con esto, el sistema puede crecer a nuevos aliados sin romper compatibilidad.

## Servicios y horarios
- `organization_services` modela oferta de servicios (costo, moneda, activo, metadata).
- `organization_schedules` modela disponibilidad semanal (día, apertura/cierre, cerrado).

Esto habilita búsquedas por tipo de servicio y por horario de atención.

## Relación con ubicación
`organizations.location_id` se conecta con `locations` para reutilizar georreferenciación ya existente y facilitar mapas/filtros por zona.

## Aprobación administrativa
La estructura soporta revisión administrativa con:
- `status` de organización,
- `approved_by`, `approved_at`, `rejected_at`,
- `rejection_reason`.

Esto deja preparada la validación de refugios/veterinarias antes de su exposición pública.
