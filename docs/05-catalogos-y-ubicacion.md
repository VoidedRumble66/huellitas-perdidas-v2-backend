# 05 - Catálogos y ubicación

## ¿Por qué usar catálogos?
Los catálogos (`species`, `breeds`, `colors`, `states`, `municipalities`, `neighborhoods`) permiten:
- Estandarizar valores para filtros y búsquedas.
- Evitar inconsistencias de escritura en datos críticos.
- Hacer más simple la validación de formularios y APIs futuras.
- Reducir la duplicación de información en módulos funcionales.

## Cobertura inicial: Chiapas y Ocosingo
Se cargan datos iniciales de Chiapas y Ocosingo porque son el punto de arranque operativo del proyecto.

Aun así, el modelo está diseñado para escalar:
- múltiples estados,
- múltiples municipios por estado,
- múltiples colonias por municipio.

Esto evita rediseños cuando la plataforma crezca a otras zonas.

## Relación con publicaciones futuras
Aunque en esta fase no se crean publicaciones ni mascotas, la estructura deja preparado el sistema para asociar datos de catálogo y ubicación a:
- reportes de mascotas perdidas,
- reportes de mascotas encontradas,
- publicaciones de adopción,
- y otros módulos georreferenciados.

## Uso de `locations` para GPS, mapas y filtros
La tabla `locations` centraliza la geolocalización reutilizable para el proyecto:
- dirección y referencia textual,
- coordenadas (`latitude`, `longitude`),
- precisión (`accuracy_meters`),
- vínculo opcional con estado, municipio y colonia.

Esto facilitará:
- filtros geográficos,
- búsqueda por zona,
- despliegue de pines en mapas,
- y auditoría de procedencia de datos.

## Flexibilidad con `locations.metadata`
El campo `metadata` (jsonb en PostgreSQL) permite guardar información adicional sin romper el esquema base, por ejemplo:
- fuente de coordenadas (GPS manual/automático),
- nombre del lugar en mapa,
- nivel de confianza o precisión extendida,
- datos de proveedor de mapas.

Así se mantiene un diseño flexible y evolutivo para siguientes fases.
