# Huellitas Perdidas v2 - Backend

Backend inicial de **Huellitas Perdidas v2**, una plataforma para gestión de casos de mascotas perdidas, encontradas y adopción.

## Stack
- Laravel 13
- PostgreSQL
- Laravel Sanctum (autenticación API por tokens)
- Eloquent ORM + Migraciones

## Requisitos
- PHP 8.2+
- Composer
- PostgreSQL 14+
- Laravel Herd (recomendado para entorno local)

## Instalación local
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Configuración de base de datos (PostgreSQL)
En `.env` usa como base:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=huellitas_perdidas_v2
DB_USERNAME=postgres
DB_PASSWORD=
```

## Ejecutar proyecto
Con Herd, abre en navegador:
- `http://huellitas-perdidas-v2.test`

Como alternativa temporal:
```bash
php artisan serve
```

## Comandos principales
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate --seed`
- `php artisan serve`

## Estado actual (fase 1)
Por ahora se implementó únicamente la base de:
- usuarios (`users`)
- roles (`roles` y pivote `role_user`)
- perfiles de usuario (`user_profiles`)

No se incluyeron aún módulos de mascotas, publicaciones, adopciones, reportes, organizaciones, reputación, métricas ni mapas.

## Documentación
Consulta la carpeta [`/docs`](docs) para arquitectura, base de datos, reglas técnicas e instalación en Herd.
