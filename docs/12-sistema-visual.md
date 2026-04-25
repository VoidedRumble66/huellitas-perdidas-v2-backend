# 12 - Sistema visual base

## Identidad y logo oficial
- Logo oficial: `public/images/logo.png`.
- Uso en Blade: `asset('images/logo.png')`.
- Debe mostrarse en navbar, footer y home pública.
- Si no existe aún, la vista usa fallback visual (texto/insignia) sin romper la carga.

## Paleta por gamas
### Naranja
`--hp-orange-50` a `--hp-orange-900` (marca principal en `--hp-orange-500: #F27F3E`).

### Gris azulado
`--hp-bluegray-50` a `--hp-bluegray-900` (institucional en `--hp-bluegray-600: #2C3E50`).

### Verde limón
`--hp-lime-50` a `--hp-lime-900` (acento en `--hp-lime-500: #A8C95F`).

### Fondos
- `--hp-bg: #F7F3EE`
- `--hp-bg-soft: #FAF8F5`
- `--hp-surface: #FFFFFF`
- `--hp-surface-muted: #F2ECE5`

### Textos y bordes
- `--hp-text: #2B2B2B`
- `--hp-text-muted: #68717A`
- `--hp-border: #E7E0D8`

### Estados
- success, warning, danger e info con variantes `-soft`.

### Modo oscuro
- `--hp-dark-bg`, `--hp-dark-surface`, `--hp-dark-surface-muted`, `--hp-dark-border`, `--hp-dark-text`, `--hp-dark-muted`.

## Reglas de uso
1. Naranja para CTA principales y detalles de marca.
2. Gris azulado para footer, bloques institucionales y contraste.
3. Verde limón para badges, chips y acciones secundarias pequeñas.
4. No usar blanco puro como fondo general (usar `--hp-bg`).
5. Cards blancas permitidas con borde suave y sombra ligera.
6. Evitar saturación cromática.

## Componentes reutilizables (CSS)
- Layout: `.hp-container`, `.hp-section`, `.hp-section-muted`, `.hp-grid`.
- Botones: `.hp-btn`, `.hp-btn-primary`, `.hp-btn-secondary`, `.hp-btn-outline`, `.hp-btn-ghost`.
- Cards base: `.hp-card`, `.hp-card-hover`, `.hp-feature-card`.
- Cards de publicaciones públicas: `.hp-post-grid`, `.hp-post-card`, `.hp-post-card-image`, `.hp-post-card-body`, `.hp-post-card-title`, `.hp-post-card-meta`, `.hp-post-card-description`, `.hp-post-card-actions`.
- Empty states: `.hp-empty-state`.
- CTA de fondo claro: `.hp-cta-panel`.
- Badges: `.hp-badge`, `.hp-badge-orange`, `.hp-badge-lime`, `.hp-badge-danger`, `.hp-badge-info`.
- Formularios: `.hp-form-group`, `.hp-label`, `.hp-input`, `.hp-select`, `.hp-textarea`, `.hp-error`.
- Alertas: `.hp-alert`, `.hp-alert-success`, `.hp-alert-warning`, `.hp-alert-danger`, `.hp-alert-info`.
- Estructura: `.hp-navbar`, `.hp-footer`.

## Modo claro/oscuro
- Se aplica con `data-theme` en `<html>`.
- Persistencia en `localStorage` con clave `huellitas-theme`.
- Si no hay preferencia guardada, se usa `prefers-color-scheme`.

## Corrección de contraste del CTA en dark mode
- Cuando un panel CTA mantiene fondo claro en dark mode, debe forzarse texto oscuro legible.
- Regla aplicada:
  - `[data-theme="dark"] .hp-cta-panel { color: #2B2B2B; }`
  - `[data-theme="dark"] .hp-cta-panel h2 { color: #2B2B2B; }`
  - `[data-theme="dark"] .hp-cta-panel p { color: #40586B; }`
- El botón primario naranja se mantiene sin cambios para preservar la jerarquía visual.

## Reglas de navbar
- Desktop: una sola línea con logo izquierda, menú centrado y acciones a la derecha.
- Navbar muestra nombre de marca junto al logo para reforzar identidad visual.
- En desktop se usa estilo compacto para mantener una sola línea limpia con enlaces largos.
- Móvil: logo izquierda, botones tema + menú derecha, menú desplegable con navegación y acceso de sesión.

## Reglas de cards de publicaciones recientes
- Para listados públicos usar también `.hp-listing-header`, `.hp-search-bar` y `.hp-pagination`.
- Para detalle público usar `.hp-detail-layout`, `.hp-detail-gallery`, `.hp-detail-main` y `.hp-detail-sidebar`.
- Máximo 4 ítems por bloque en home para priorizar escaneo rápido.
- Imagen arriba; si no existe, usar placeholder interno con “Sin imagen”.
- Metadatos mínimos: especie, raza (si existe), ubicación, resumen corto.
- Acciones con contraste alto y sin estados que parezcan deshabilitados.

## Reglas de empty states
- Deben usar `hp-card` y `hp-empty-state`.
- Incluir icono simple SVG, título claro y texto orientativo.
- Mantener fondo suave en claro y contraste correcto en oscuro.

## Contraste en modo oscuro
- `.hp-btn-outline` en dark debe verse activo y legible (texto claro, borde visible, hover naranja).
- Botones principales y secundarios deben mantener contraste AA en fondos oscuros.
- Evitar opacidades bajas en botones interactivos.

## Reglas para futuras pantallas
1. Preferir clases reusable de `huellitas.css` antes de estilos nuevos.
2. Evitar estilos inline extensos en Blade.
3. Mantener mínimo 44px en controles táctiles principales.
4. Mantener foco visible y navegación por teclado.
5. No usar colores fuera de la paleta salvo caso justificado.

## Tipografía oficial
- Fuente principal: **Montserrat** (400, 500, 600, 700, 800, 900).
- Fallback: `'Montserrat', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif`.

## Reglas del logo
- Logo oficial: `public/images/logo.png`.
- Debe renderizarse sin fondo agregado, sin borde, sin recorte y sin redondeo forzado.
- Clase recomendada: `.hp-logo-img` con `object-fit: contain`.
