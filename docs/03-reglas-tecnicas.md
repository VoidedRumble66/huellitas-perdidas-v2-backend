# 03 - Reglas técnicas

1. No concatenar SQL manualmente.
2. Usar Eloquent o Query Builder para acceso a datos.
3. Usar Form Requests para validaciones futuras.
4. Usar Policies para permisos futuros.
5. Usar SoftDeletes donde tenga sentido.
6. Usar migraciones para todo cambio de base de datos.
7. Mantener documentación actualizada en `/docs`.
8. No crear lógica de negocio directamente en rutas.
9. Separar responsabilidades entre modelos, controladores, requests y servicios cuando el proyecto crezca.
