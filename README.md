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


## Enfoque actual del producto
Huellitas Perdidas v2 iniciará como una plataforma web responsive con características PWA instalable. Esto permitirá que los usuarios accedan desde navegador o instalen el sitio en su celular como icono tipo app. La arquitectura permanecerá preparada para una futura aplicación móvil nativa o híbrida mediante API.

- Base de datos principal completada.
- Enfoque actualizado a Web Responsive + PWA + API-ready architecture.

## Progreso del proyecto
- ✅ Fase 1 completada: usuarios, roles y perfiles.
- ✅ Fase 2 completada: catálogos y ubicación.
- ✅ Fase 3 completada: mascotas y publicaciones.
- ✅ Bloque A completado: comentarios, avistamientos, reportes y moderación.
- ✅ Bloque B completado: adopciones y organizaciones.

Módulos siguientes: implementación de funcionalidades de negocio, flujo web responsive y capacidades PWA progresivas.

## Documentación
Consulta la carpeta [`/docs`](docs) para arquitectura, base de datos, reglas técnicas e instalación en Herd.
