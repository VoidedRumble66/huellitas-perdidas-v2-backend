# 03 - Reglas técnicas

1. No concatenar SQL manualmente.
2. Usar Eloquent o Query Builder para acceso a datos.
3. Usar Form Requests para validaciones futuras.
4. Usar Policies para permisos futuros.
5. Usar SoftDeletes donde tenga sentido.
6. Usar migraciones para todo cambio de base de datos.
7. Mantener documentación actualizada en `/docs`.
8. No crear lógica de negocio directamente en rutas.
9. La lógica de negocio no debe quedar directamente en vistas Blade.
10. La lógica compleja no debe quedar directamente en controladores.
11. Para casos importantes se usarán Actions o Services.
12. Los controladores web deben poder reutilizar lógica que en el futuro puedan usar controladores API.
13. La PWA no debe cachear datos sensibles.
14. Las rutas administrativas no deben cachearse en el service worker.
15. Tokens, sesiones o datos privados no deben guardarse en caché pública.
16. Mantener identidad visual consistente con el sistema definido en `docs/12-sistema-visual.md`.
17. Usar una sola familia de iconografía por pantalla para evitar inconsistencias.
18. Garantizar contraste, foco visible y controles táctiles cómodos en móvil.
19. Evitar componentes frontend pesados cuando CSS reusable cubra el requerimiento.
20. Toda nueva vista pública debe soportar tema claro/oscuro y layout responsive.

21. Usar logo oficial en `public/images/logo.png`; no usar rutas o logos alternos.
22. Evitar estilos inline extensos en Blade; preferir clases reusable en `public/css/huellitas.css`.
23. Mantener la paleta por gamas definida en `docs/12-sistema-visual.md`.
