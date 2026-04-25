# 01 - Arquitectura base

## Visión general
Huellitas Perdidas v2 adopta una arquitectura **web-first** con Laravel como núcleo del sistema. En esta etapa, Laravel funciona tanto como backend como capa web principal.

## Backend y capa web principal
- **Laravel** se usa para reglas de negocio, acceso a datos, seguridad y entrega de vistas web.
- La interfaz inicial será renderizada con **Blade** (server-side rendering), priorizando simplicidad y velocidad de implementación.
- La experiencia inicial del producto será **web responsive mobile-first**.

## Base de datos
- **PostgreSQL** es la base de datos principal.
- El esquema actual cubre usuarios, publicaciones, mascotas, moderación, adopciones, organizaciones, reputación y auditoría.

## Estrategia PWA
- El producto iniciará como una plataforma web con capacidades de **PWA instalable**.
- Los usuarios podrán acceder desde navegador y también instalar la aplicación web como ícono en el celular.
- Esta etapa prioriza una implementación PWA base, con evolución progresiva de capacidades offline y notificaciones.

## Autenticación y API futura
- **Laravel Sanctum** se conserva para soportar autenticación en una **API futura**.
- Aunque el foco inicial no es API pública completa, la arquitectura queda preparada para exponer servicios a clientes móviles más adelante.

## Escalabilidad para futura app móvil
- El dominio y la persistencia se mantienen independientes de la capa visual.
- La lógica de negocio deberá moverse progresivamente a **Actions/Services** para reutilizarse entre controladores web y API.
- Esto permite que una app nativa o híbrida futura consuma la misma lógica mediante API.

## Decisiones explícitas de esta etapa
En esta fase **no** se usará:
- Flutter
- React
- Vue
- Inertia
- Livewire (se deja como opción futura, pero no se instala ahora)

## Evolución de UI
- **Blade** es la tecnología inicial de vistas.
- **Livewire** podrá evaluarse en una fase posterior para interacciones dinámicas sin adoptar un frontend SPA completo.

## Entorno local
El entorno recomendado y documentado sigue siendo **Laravel Herd**.
