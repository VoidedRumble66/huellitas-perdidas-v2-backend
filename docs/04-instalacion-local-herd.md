# 04 - Instalación local con Laravel Herd

## 1) Ubicar o vincular proyecto en Herd
- Coloca el proyecto dentro de la carpeta monitoreada por Herd, o
- Vincula la carpeta del proyecto con Herd para que resuelva el dominio local.

## 2) Configurar entorno
```bash
cp .env.example .env
```

Luego ajusta variables de PostgreSQL en `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=huellitas_perdidas_v2
DB_USERNAME=postgres
DB_PASSWORD=
```

## 3) Crear base de datos
Crea la base `huellitas_perdidas_v2` en tu servidor PostgreSQL local.

## 4) Instalar dependencias y llave
```bash
composer install
php artisan key:generate
```

## 5) Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

## 6) Probar en navegador
Si Herd detecta correctamente el proyecto, abre:
- `http://huellitas-perdidas-v2.test`

Si no aparece de inmediato, puedes usar temporalmente:
```bash
php artisan serve
```
