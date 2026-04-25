# 12 - Sistema visual base

## Objetivo
Definir una base visual reusable para Huellitas Perdidas v2 con identidad de marca consistente, mobile-first, PWA y soporte claro/oscuro.

## Paleta por gamas (obligatoria)

### Naranja (marca)
- `--hp-orange-50: #FFF2E9;`
- `--hp-orange-100: #FFE1CC;`
- `--hp-orange-200: #FFC39B;`
- `--hp-orange-300: #FFA36A;`
- `--hp-orange-400: #F98F50;`
- `--hp-orange-500: #F27F3E;`
- `--hp-orange-600: #D96528;`
- `--hp-orange-700: #B94F1E;`
- `--hp-orange-800: #8F3E1B;`
- `--hp-orange-900: #6F3219;`

### Gris azulado (institucional/contraste)
- `--hp-bluegray-50: #EEF3F7;`
- `--hp-bluegray-100: #D8E2EA;`
- `--hp-bluegray-200: #B4C5D1;`
- `--hp-bluegray-300: #8BA4B5;`
- `--hp-bluegray-400: #617F93;`
- `--hp-bluegray-500: #40586B;`
- `--hp-bluegray-600: #2C3E50;`
- `--hp-bluegray-700: #243444;`
- `--hp-bluegray-800: #1C2A38;`
- `--hp-bluegray-900: #15212D;`

### Verde limón (acento)
- `--hp-lime-50: #F7FBEF;`
- `--hp-lime-100: #EDF6D6;`
- `--hp-lime-200: #DCEEB0;`
- `--hp-lime-300: #C9E283;`
- `--hp-lime-400: #B7D65E;`
- `--hp-lime-500: #A8C95F;`
- `--hp-lime-600: #8EAE43;`
- `--hp-lime-700: #708B32;`
- `--hp-lime-800: #586D2A;`
- `--hp-lime-900: #455522;`

### Fondos
- `--hp-bg: #FAF8F5;`
- `--hp-bg-soft: #F7F5F1;`
- `--hp-surface: #FFFFFF;`
- `--hp-surface-muted: #F2EFEA;`

### Estados
- `--hp-success: #4F9D69;`
- `--hp-success-soft: #EAF7EF;`
- `--hp-warning: #E9A23B;`
- `--hp-warning-soft: #FFF5E3;`
- `--hp-danger: #D9534F;`
- `--hp-danger-soft: #FDECEC;`
- `--hp-info: #4A90A4;`
- `--hp-info-soft: #EAF6F8;`

### Modo oscuro
- `--hp-dark-bg: #151B22;`
- `--hp-dark-surface: #1F2832;`
- `--hp-dark-surface-muted: #27313D;`
- `--hp-dark-border: #334252;`
- `--hp-dark-text: #F4F6F8;`
- `--hp-dark-muted: #B8C2CC;`

## Reglas de uso
1. El naranja `#F27F3E` se usa en CTA principales, detalles de marca y enlaces importantes.
2. El gris azulado `#2C3E50` se usa en footer, bloques institucionales, navbar oscuro y contraste.
3. El verde limón `#A8C95F` se usa en badges, etiquetas, estados positivos, chips y acciones secundarias cortas.
4. No usar blanco puro como fondo general; usar `--hp-bg`.
5. Las cards pueden ser blancas con borde suave y sombra ligera.
6. Evitar saturación cromática: priorizar legibilidad y jerarquía visual.

## Tipografía base
- Stack recomendada: `Inter`, `Segoe UI`, `Roboto`, `system-ui`.
- Títulos fluidos con `clamp()` y cuerpo legible en móvil.

## Componentes reutilizables
Definidos en `public/css/huellitas.css`:
- Botones: `btn-primary`, `btn-secondary`, `btn-outline`.
- Cards: `card`, `status-lost`, `status-found`, `status-adoption`.
- Chips/badges: `chip`, `chip-lime`, `chip-warning`, `chip-danger`.
- Alertas: `alert`, `alert-info`.
- Formularios: `form-control`.
- Layout base: `container`, `section`, `grid-cards`.

## Iconografía
- Usar una sola familia de iconos SVG coherentes por pantalla.
- Mantener consistencia en estilo de redes (Facebook, WhatsApp, Instagram).

## Lineamientos para futuras pantallas
1. Reutilizar clases del sistema visual antes de crear estilos ad-hoc.
2. Mantener contraste y foco visible para accesibilidad.
3. Priorizar controles táctiles cómodos (mínimo 44px en interacciones clave).
4. Garantizar compatibilidad clara/oscura en cada nueva pantalla pública.
5. Mantener identidad emocional, comunitaria y amigable de Huellitas.
