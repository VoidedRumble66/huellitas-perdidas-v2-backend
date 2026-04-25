# 01 - Arquitectura base

## Backend / API
El proyecto usa Laravel como núcleo del backend para exponer endpoints API, manejar reglas de negocio y orquestar persistencia con Eloquent.

## Base de datos
PostgreSQL es la base principal por su robustez, consistencia y escalabilidad para fases posteriores.

## Autenticación
Se utiliza Laravel Sanctum para autenticación basada en tokens personales, ideal para la futura integración con Flutter.

## Cliente móvil futuro
La app móvil será Flutter y consumirá los endpoints del backend.

## Panel administrativo futuro
Se deja preparado el terreno para construir panel administrativo en Blade y potencialmente Livewire. En esta fase no se implementa panel avanzado.

## Decisiones explícitas de esta etapa
En esta fase **no** se usa:
- React
- Vue
- Inertia

Esto reduce complejidad inicial y permite consolidar la base de datos y el dominio antes de agregar una capa frontend compleja.

## Entorno local
El entorno recomendado y documentado es Laravel Herd.
