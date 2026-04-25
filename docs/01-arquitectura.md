# 01 - Arquitectura base

## Visión general
Huellitas Perdidas v2 adopta una arquitectura **web-first** con Laravel como núcleo del sistema. En esta etapa, Laravel funciona como backend y capa web principal con una experiencia responsive + PWA.

## Backend y capa web principal
- **Laravel** se usa para reglas de negocio, seguridad, persistencia y renderizado inicial de vistas.
- La UI base se construye con **Blade** y un sistema visual reusable propio.
- El producto se desarrolla en enfoque **mobile-first**, priorizando usabilidad desde navegador móvil.

## Sistema visual y UX
- Identidad visual propia de Huellitas con paleta por gamas y componentes reusable.
- Logo oficial preparado en `public/images/logo.png` (render con fallback cuando aún no exista).
- Soporte de modo claro/oscuro en layout base con persistencia en navegador.

## Base de datos
- **PostgreSQL** es la base principal.
- El modelo actual cubre usuarios, publicaciones, mascotas, moderación, adopciones, organizaciones, reputación y auditoría.

## Estrategia PWA
- El producto inicia como web con capacidades de **PWA instalable**.
- Manifest y service worker se mantienen activos y alineados al sistema visual.
- La estrategia de caché evita datos sensibles y rutas privadas.

## Autenticación y API futura
- **Laravel Sanctum** se conserva para autenticación en una API futura.
- La arquitectura se mantiene API-ready para una futura app móvil nativa o híbrida.

## Escalabilidad para futura app móvil
- Dominio y persistencia desacoplados de la capa visual.
- La lógica de negocio debe vivir en **Actions/Services** para reutilización entre web y API.
- Controladores web y API futuros compartirán reglas de negocio comunes.

## Decisiones explícitas de esta etapa
En esta fase **no** se usa:
- Flutter
- React
- Vue
- Inertia
- Livewire (opción futura, no instalado por ahora)

## Entorno local
El entorno recomendado sigue siendo **Laravel Herd**.
